@php /** @var \Authanram\Resources\Http\Actions\IndexAction $action */ @endphp
@php /** @var \Authanram\Resources\Entities\Fields\BaseField $field */ @endphp

<li class="{{ $action->theme(['resources.list', 'row', 'column', 'resources.actions.index.fields.row']) }}">

    @foreach ($action->getFields() as $field)

        <div class="{{ $field->getClass($action->getAction(), $action->theme('resources.actions.index.fields.value')) }}">

            {!! view($field->getView(), compact(['action']), ['field' => $field->with($model)]) !!}

        </div>

    @endforeach

    <div class="{{ $action->theme('resources.actions.index.invokers.container') }}">

        @include ($action->theme('resources.views.invokers', 'authanram-resources::actions.index.invoker-edit'))

    </div>

</li>
