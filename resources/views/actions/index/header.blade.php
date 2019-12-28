@php /** @var \Authanram\Resources\Http\Actions\IndexAction $action */ @endphp
@php /** @var \Authanram\Resources\Entities\Fields\BaseField $field */ @endphp

<li class="{{ $action->theme('index.list.header.container') }}">

    @foreach ($action->getFields() as $field)

        <div class="{{ $field->getClass($action->theme('index.list.field', 'index.list.header.field')) }}">

            {{ $field->getLabel() }}

        </div>

    @endforeach

    <div class="{{ $action->theme('index.list.invokers.container') }}"></div>

</li>
