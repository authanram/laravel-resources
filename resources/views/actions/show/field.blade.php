@php /** @var \Authanram\Resources\Http\Actions\EditAction $action */ @endphp
@php /** @var \Authanram\Resources\Entities\Fields\BaseField $field */ @endphp

@php ($block = $field->isBlock($field) ? 'block.' : '')

<div class="{{ $action->theme(['resources.list', !$field->isBlock($field) ? 'row' : null, 'resources.actions.show.fields.row']) }}">

    <div class="{{ $action->theme("resources.actions.show.fields.{$block}container") }}">

        <div class="{{ $action->theme(['resources.list.column', "resources.actions.show.fields.{$block}label"]) }}">

            {{ $field->getLabel() }}

        </div>

        <div class="{{ $action->theme(['resources.list.column', "resources.actions.show.fields.{$block}field"]) }}">

            {!! view($field->getView(), [

                'action' => $action,

                'field' => $field->with($action->getModel())

            ]) !!}

        </div>

    </div>

</div>

@if (! $loop->last)

    <div class="w-full">

        <div class="border-t"></div>

    </div>

@endif
