@php /** @var \Resources\Http\Actions\IndexAction $action */ @endphp
@php /** @var \Resources\Entities\Fields\BaseField $field */ @endphp

@foreach ($action->getRows() as $model)

    <li class="{{ $action->theme('index.list.row') }}">

        @foreach ($action->getFields() as $field)

            <div class="{{ $field->getClass($action->theme('index.list.field')) }}">

                {!! view($field->getView(), compact(['action']), ['field' => $field->with($model)]) !!}

            </div>

        @endforeach

    </li>

@endforeach
