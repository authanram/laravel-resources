@php /** @var \Authanram\Resources\Http\Actions\IndexAction $action */ @endphp
@php /** @var \Authanram\Resources\Entities\Fields\BaseField $field */ @endphp

<li class="{{ $action->theme('actions.index.header.container') }}">

    @foreach ($action->getFields() as $field)

        <div class="{{ $field->getClass($action->getAction(), $action->theme('actions.index.fields.field')) }}">

            {{ $field->getLabel() }}

        </div>

    @endforeach

    <div class="{{ $action->theme('actions.index.invokers.container') }}"></div>

</li>
