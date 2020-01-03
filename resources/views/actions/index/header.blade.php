@php /** @var \Authanram\Resources\Http\Actions\IndexAction $action */ @endphp
@php /** @var \Authanram\Resources\Entities\Fields\BaseField $field */ @endphp

<li class="{{ $action->theme(['resources.list', 'row', 'column', 'resources.actions.index.fields', 'row', 'header']) }}">

    @foreach ($action->getFields() as $field)

        <div class="{{ $field->getClass($action->getAction(), $action->theme('resources.actions.index.fields.value')) }}">

            {{ $field->getLabel() }}

        </div>

    @endforeach

    <div class="{{ $action->theme('resources.actions.index.invokers.container') }}"></div>

</li>
