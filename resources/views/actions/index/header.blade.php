@php /** @var \Resources\Http\Actions\IndexAction $action */ @endphp
@php /** @var \Resources\Entities\Fields\BaseField $field */ @endphp

<li class="{{ $action->theme('index.list.header') }}">

    @foreach ($action->getFields() as $field)

        <div class="{{ $field->getClass($action->theme('index.list.field')) }}">

            {{ $field->getLabel() }}

        </div>

    @endforeach

</li>
