<?php

namespace Authanram\Resources\Plugins\Actions;

use Authanram\Resources\Contracts\ActionPluginContract;
use Authanram\Resources\Entities;
use Authanram\Resources\Entities\Fields\BaseField;
use Authanram\Resources\Http\Actions\Action;
use Authanram\Resources\Plugins\Concerns\MakeField;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\ViewErrorBag;

final class SetFields implements ActionPluginContract
{
    use MakeField;

    private Action $action;

    public function handle(Action $action, Request $request): void
    {
        $this->action = $action;

        $fields = $this->makeFields()

            ->map(function ($field) use ($request) {

                $field = \is_string($field) ? (object)['attribute' => $field] : $field;

                $error = static::makeFieldError($request, $field->attribute);

                $instance = $this->makeField($field, $error);

                return $this->handleDefaultPlugins($instance);

            })->filter(function (BaseField $field) {

                return ! \in_array($field->getAttribute(), $this->makeRelationKeys(), true)

                    || $this->action->getAction() !== Entities\Action::SHOW;

            });

        $this->action->setFields($fields);
    }

    private function handleDefaultPlugins(BaseField $field): BaseField
    {
        $plugins = collect(config('authanram-resources-plugins.fields.default'));

        $fn = fn ($plugin) => (new $plugin)->handle($field);

        $plugins->each($fn);

        return $field;
    }

    private static function makeFieldError(Request $request, string $attribute): ?string
    {
        /** @var ViewErrorBag $errors */
        $errors = $request->session()->get('errors');

        $messages = $errors ? $errors->getMessages() : [];

        $fieldMessages = $messages[$attribute] ?? [];

        return \array_shift($fieldMessages);
    }

    private function makeFields(): Collection
    {
        $name = $this->action->getAction();

        $fallbackFields = $this->makeFallbackFields($name);

        $path = "actions.$name.fields";

        $fields = take($this->action->getRawResource(), $path)->toCollection();

        if (! $fallbackFields) {

            return $fields;

        }

        return $this->mergeFields($fields, $fallbackFields);
    }

    private function makeFallbackFields(string $action): ?Collection
    {
        $fallbackMap = [

            Entities\Action::EDIT => Entities\Action::CREATE,

            Entities\Action::INDEX => Entities\Action::SHOW,

        ];

        $fallbackAction = $fallbackMap[$action] ?? null;

        if (!$fallbackAction) {

            return null;

        }

        $path = "actions.$fallbackAction.fields";

        return take($this->action->getRawResource(), $path)->toCollection();
    }

    private function mergeFields(Collection $fields, Collection $fallbackFields): Collection
    {
        $missingFields = $fallbackFields->diffKeys($fields);

        return $fields->merge($missingFields);
    }

    private function makeRelationKeys(): array
    {
        $raw = $this->action->getRawResource();

        $relations = take($raw, 'actions.show.relations')->toCollection();

        return $relations->pluck('attribute')->toArray();
    }
}
