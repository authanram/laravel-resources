<?php

namespace Authanram\Resources\Entities\Fields;

use Authanram\Resources\Contracts\InputOutputFieldPluginContract;
use Authanram\Resources\Entities\Fields\Concerns;
use Authanram\Resources\Plugins\Concerns\MakeField;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BaseField
{
    use Concerns\HasAssociations;
    use Concerns\HasAttribute;
    use Concerns\HasClass;
    use Concerns\HasError;
    use Concerns\HasField;
    use Concerns\HasInvokers;
    use Concerns\HasLabel;
    use Concerns\HasRelations;
    use Concerns\HasType;
    use Concerns\HasValue;
    use Concerns\HasView;
    use Concerns\IsBlock;
    use MakeField;

    public function __construct(Field $field)
    {
        $this->field = $field;

        $this->attribute = (string)$this->field->get('attribute');

        $this->setProperties();
    }

    public function with(Model $model): self
    {
        $this->field->setModel($model);

        $this->setProperties();

        $this->handle();

        return $this;
    }

    protected static function makeLabelFromAttribute(string $attribute): string
    {
        $snake = Str::snake($attribute);

        $title = Str::title($snake);

        return str_replace('_', ' ', $title);
    }

    protected function setProperties(): void
    {
        $this->type = $this->field->get('type');

        $this->view = empty($this->view) ? 'authanram-resources::fields.blank' : $this->view;

        if ($this->field->get('label') !== false) {
            $this->label = static::makeLabelFromAttribute($this->field->get('label', $this->attribute));
        }

        $this->value = $this->makeValue();

        $this->labelFalse = $this->field->get('labelFalse', '');

        $this->labelTrue = $this->field->get('labelTrue', '');
    }

    protected function handle(): void
    {
        $resourceField = (object)$this->field->toArray();

        $interactionType = $this->field->getInteractionType();

        $pluginClass = $this->makeFieldPluginClassName($resourceField, $interactionType);

        /** @var InputOutputFieldPluginContract $instance */
        $instance = new $pluginClass;

        $instance->handle($this);
    }

    /**
     * @return mixed
     */
    private function makeValue()
    {
        $value = $this->field->getModel()

            ? $this->field->getModel()->{$this->getAttribute()}

            : $this->field->get('value');

        return old($this->getAttribute(), $value);
    }
}
