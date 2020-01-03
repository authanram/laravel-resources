@php /** @var \Authanram\Resources\Http\Actions\EditAction $action */ @endphp
@php /** @var \Authanram\Resources\Entities\Fields\BaseField $field */ @endphp

<div class="{{ $field->getClass($action->getAction(), $action->theme(['resources.list', 'row', 'resources.actions.show.fields.row'])) }}">

    <div class="{{ $action->theme('resources.actions.show.fields.container') }}">

        <div class="{{ $action->theme(['resources.list.column', 'resources.actions.show.fields.label']) }}">

            {{ $field->getLabel() }}

        </div>

        <div class="{{ $action->theme(['resources.list.column', 'resources.actions.show.fields.field']) }}">

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
