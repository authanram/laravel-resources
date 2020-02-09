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

        $fallbackFieldCollection = $this->makeFallbackFieldCollection($name);

        $rawResource = $this->action->getRawResource();

        $fields = data_get($rawResource, "actions.$name.fields");

        $fieldCollection = collect($fields);

        if (! $fallbackFieldCollection) {

            return $fieldCollection;

        }

        return $this->mergeFieldCollections($fieldCollection, $fallbackFieldCollection);
    }

    private function makeFallbackFieldCollection(string $action): ?Collection
    {
        $fallbackMap = [

            Entities\Action::EDIT => Entities\Action::CREATE,

            Entities\Action::SHOW => Entities\Action::CREATE,

        ];

        $fallbackAction = $fallbackMap[$action] ?? null;

        if (!$fallbackAction) {

            return null;

        }

        $rawResource = $this->action->getRawResource();

        $fallbackFields = data_get($rawResource, "actions.$fallbackAction.fields");

        return collect($fallbackFields);
    }

    private function mergeFieldCollections(Collection $fields, Collection $fallbackFields): Collection
    {
        $fieldAttributes = $fields->pluck('attribute');

        $fallbackAttributes = $fallbackFields->pluck('attribute');

        $missingFields = $fallbackAttributes->diff($fieldAttributes);

        $missingFields->each(static function (string $attribute) use ($fields, $fallbackFields) {

            $fields->add($fallbackFields->where('attribute', $attribute)->first());

        });

        return $fields;
    }

    private function makeRelationKeys(): array
    {
        $raw = $this->action->getRawResource();

        $relations = data_get($raw, 'actions.show.relations');

        return collect($relations)->pluck('attribute')->toArray();
    }
}
