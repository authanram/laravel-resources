@php /** @var \Authanram\Resources\Http\Actions\IndexAction $action */ @endphp
@php /** @var \Authanram\Resources\Entities\Fields\BaseField $field */ @endphp

<li class="{{ $action->theme(['resources.list', 'row', 'resources.actions.index.fields', 'row', 'header']) }}">

    @foreach ($action->getFields() as $field)

        <p class="{{ $field->getClass($action->getAction(), $action->theme(['resources.list.column', 'resources.actions.index.fields.value'])) }}">

            <span class="{{ $action->theme('resources.fields.default') }}">

                {{ $field->getLabel() }}

            </span>

        </p>

    @endforeach

    <p class="{{ $action->theme('resources.actions.index.invokers.container') }}"></p>

</li>
