<?php

namespace Authanram\Resources\Plugins\Actions;

use Authanram\Resources\Contracts\ActionPluginContract;
use Authanram\Resources\Entities\Fields\BaseField;
use Authanram\Resources\Http\Actions\Action;
use Authanram\Resources\Plugins\Concerns\MakeField;
use Illuminate\Http\Request;

final class SetMetaFields implements ActionPluginContract
{
    use MakeField;

    private Action $action;

    public function handle(Action $action, Request $request): void
    {
        $this->action = $action;

        $createdAt = $this->makeMetaField($action, 'created_at');

        $updatedAt = $this->makeMetaField($action, 'updated_at');

        $metaFields = collect([$createdAt, $updatedAt]);

        $action->setMetaFields($metaFields);
    }

    private function makeMetaField(Action $action, string $attribute): BaseField
    {
        $field = $action->getRawResource()->fields->{$attribute};

        $field->attribute = $attribute;

        return $this->makeField($field);
    }
}
