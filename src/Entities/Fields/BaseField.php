<?php

namespace Authanram\Resources\Entities\Fields;

use App\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Authanram\Resources\Contracts\InputOutputPluginContract;

class BaseField
{
    protected $value;

    protected ?string $class = null;

    protected ?string $error = null;

    protected Collection $association;

    protected Collection $invokers;

    protected string $attribute;

    protected string $label;

    protected string $labelView = 'authanram-resources::actions.label';

    protected string $type;

    protected string $view;

    protected Field $field;

    public function __construct(Field $field)
    {
        $this->field = $field;

        $this->attribute = (string)$this->field->get('attribute');

        $this->setProperties();
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getClass(string $append = null): ?string
    {
        return trim("$this->class $append");
    }

    public function getError(): ?string
    {
        return $this->error;
    }

    public function getAssociation(): Collection
    {
        return $this->association ?? collect();
    }

    public function getInvokers(): Collection
    {
        return $this->invokers;
    }

    public function getAttribute(): string
    {
        return $this->attribute;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getLabelView(): string
    {
        return $this->labelView;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getView(): string
    {
        return $this->view;
    }

    public function getField(): Field
    {
        return $this->field;
    }

    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    public function setClass(?string $class): self
    {
        $this->class = $class;

        return $this;
    }

    public function setError(?string $error): self
    {
        $this->error = $error;

        return $this;
    }

    public function setAssociation(Collection $association): self
    {
        $this->association = $association;

        return $this;
    }

    public function setInvokers(Collection $invokers): self
    {
        $this->invokers = $invokers;

        return $this;
    }

    public function setAttribute(string $attribute): self
    {
        $this->attribute = $attribute;

        return $this;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function setLabelView(string $labelView): self
    {
        $this->labelView = $labelView;

        return $this;
    }

    public function setType(string $type): BaseField
    {
        $this->type = $type;

        return $this;
    }

    public function setView(string $view): self
    {
        $this->view = $view;

        return $this;
    }

    public function setField(Field $field): self
    {
        $this->field = $field;

        return $this;
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

        $this->label = static::makeLabelFromAttribute($this->attribute);

        $this->value = $this->makeValue();
    }

    protected function handle(): void
    {
        $fn = fn (InputOutputPluginContract $plugin) => $plugin->handle($this);

        $this->getPlugins()->each($fn);
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

    /**
     * @return Collection|InputOutputPluginContract[]
     */
    private function getPlugins(): Collection
    {
        $interactionType = $this->getField()->getInteractionType();

        $pluginClasses = config("authanram-resources-plugins.fields.$interactionType");

        $fn = fn (string $pluginClass) => new $pluginClass;

        $instances = collect($pluginClasses)->map($fn);

        return $this->filterApplicablePlugins($instances);
    }

    private function filterApplicablePlugins(Collection $plugins): Collection
    {
        return $plugins->filter(function (InputOutputPluginContract $plugin) {

            $shortName = Str::afterLast(\get_class($plugin), '\\');

            return Str::camel($shortName) === $this->getType();

        });
    }
}
