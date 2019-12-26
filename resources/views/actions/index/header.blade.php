@php /** @var \Authanram\Resources\Http\Actions\IndexAction $action */ @endphp
@php /** @var \Authanram\Resources\Entities\Fields\BaseField $field */ @endphp

<li class="{{ $action->theme('index.list.header') }}">

    @foreach ($action->getFields() as $field)

        <div class="{{ $field->getClass($action->theme('index.list.field')) }}">

            {{ $field->getLabel() }}

        </div>

    @endforeach

    <div class="{{ $action->theme('invokers.invoker') }}"></div>

</li>
