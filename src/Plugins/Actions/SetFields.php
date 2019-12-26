<?php

namespace Resources\Plugins\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\ViewErrorBag;
use Resources\Contracts\ActionPluginContract;
use Resources\Entities;
use Resources\Entities\Fields\BaseField;
use Resources\Entities\Fields\Field;
use Resources\Http\Actions\Action;

final class SetFields implements ActionPluginContract
{
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

            });

        $this->action->setFields($fields);
    }

    private function makeField(\stdClass $field, ?string $error): BaseField
    {
        $resourceField = $this->makeResourceFields()->get($field->attribute);

        $className = $this->makeFieldClassName($resourceField);

        if (!class_exists($className)) {

            throw new \RuntimeException("Class \"$className\" not found.");

        }

        $rawResource = $this->makeAssociationRawResource($field);

        $mergedField = \array_merge((array)$field, (array)$resourceField, compact('rawResource'));

        $fieldEntity = new Field($mergedField);

        $fieldEntity->setInteractionType($this->action->getInteractionType());

        /** @var BaseField $fieldInstance */
        $fieldInstance = new $className($fieldEntity);

        $fieldInstance->setError($error);

        return $fieldInstance;
    }

    private function handleDefaultPlugins(BaseField $field): BaseField
    {
        $plugins = collect(config('authanram-resources-plugins.fields.default'));

        $fn = fn ($plugin) => (new $plugin)->handle($field);

        $plugins->each($fn);

        return $field;
    }

    private function makeFieldClassName(\stdClass $resourceField): string
    {
        $namespace = $this->makeFieldNamespace();

        $shortName = Str::studly($resourceField->type) . 'Entity';

        return $namespace . '\\' . $shortName;
    }

    private function makeFieldNamespace(): string
    {
        $interactionType = $this->action->getInteractionType();

        $studly = Str::studly($interactionType);

        return "\\Resources\\Entities\\Fields\\$studly";
    }

    private static function makeFieldError(Request $request, string $attribute): ?string
    {
        /** @var ViewErrorBag $errors */
        $errors = $request->session()->get('errors');

        $messages = $errors ? $errors->getMessages() : [];

        $fieldMessages = $messages[$attribute] ?? [];

        return \array_shift($fieldMessages);
    }

    private function makeResourceFields(): Collection
    {
        return take($this->action->getRawResource(), 'fields')->toCollection();
    }

    private function makeAssociationRawResource(\stdClass $field): ?\stdClass
    {
        return $this->action->getRawResource()->asscociations->get($field->attribute);
    }

    private function makeFields(): Collection
    {
        $name = $this->action->getAction();

        $fallbackFields = $this->makeFallbackFields($name);

        $path = "actions.$name.fields";

        $fields = take($this->action->getRawResource(), $path)->toCollection();

        return static::mergeFields($fields, $fallbackFields);
    }

    private function makeFallbackFields(string $action): ?Collection
    {
        $fallbackMap = [

            Entities\Action::EDIT => Entities\Action::CREATE,

            Entities\Action::INDEX => Entities\Action::SHOW

        ];

        $fallbackAction = $fallbackMap[$action] ?? null;

        if (!$fallbackAction) {

            return null;

        }

        $path = "actions.$fallbackAction.fields";

        return take($this->action->getRawResource(), $path)->toCollection();
    }

    private static function mergeFields(Collection $fields, ?Collection $fallbackFields): Collection
    {
        if (!$fallbackFields) {

            return $fields;

        }

        $missingFields = $fallbackFields->diffKeys($fields);

        return $fields->merge($missingFields);
    }
}
