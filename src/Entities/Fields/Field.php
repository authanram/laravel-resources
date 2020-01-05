<?php

namespace Authanram\Resources\Entities\Fields;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Fluent;

class Field extends Fluent
{
    protected string $interactionType;

    protected ?Model $model = null;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->attributes = static::unsetEmptyAttributes($data);
    }

    public function getInteractionType(): string
    {
        return $this->interactionType;
    }

    public function getModel(): ?Model
    {
        return $this->model;
    }

    public function setInteractionType(string $interactionType): self
    {
        $this->interactionType = $interactionType;

        return $this;
    }

    public function setModel(?Model $model): Field
    {
        $this->model = $model;

        return $this;
    }

    private static function unsetEmptyAttributes(array $data): array
    {
        foreach ($data as $key => $value) {

            if (empty($value) && $value !== false) {

                unset($data[$key]);

            }

        }

        return $data;
    }
}
