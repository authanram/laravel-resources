<?php

namespace Authanram\Resources\Http\Actions\Concerns;

use Illuminate\Database\Eloquent\Model;
use Authanram\Resources\Entities\Association;

trait StoresInput
{
    private function save(array $input): void
    {
        /** @var Model $model */
        $model = $this->getModel();

        $fillableInput = $this->getFillableInput($input);

        $model->fill($fillableInput)->save();
    }

    private function syncManyToManyAssociations(array $input): void
    {
        $syncableAssociationNames = $this->getSyncableAssociationNames();

        foreach ($syncableAssociationNames as $syncableAssociationName) {

            $values = $input[$syncableAssociationName];

            $this->getModel()

                ->{$syncableAssociationName}()

                ->sync($values);

        }
    }

    private function getFillableInput(array $input): array
    {
        /** @var Model $model */
        $model = $this->getModel();

        $fillable = $model->getFillable();

        $fn = fn ($value, string $key) => \in_array($key, $fillable, true);

        $fillableInput = collect($input)->filter($fn);

        return $fillableInput->toArray();
    }

    private function getSyncableAssociationNames(): array
    {
        $associations = Association::TYPES;

        $resourceFields = take($this->getRawResource(), 'fields')->toCollection();

        $fn = fn (\stdClass $resourceField) => \in_array(take($resourceField)->get('type'), $associations, true);

        $syncableAssociations = $resourceFields->filter($fn);

        return $syncableAssociations->keys()->toArray();
    }
}
