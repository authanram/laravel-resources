@php /** @var \Authanram\Resources\Http\Actions\IndexAction $action */ @endphp
@php /** @var \Authanram\Resources\Entities\Fields\BaseField $field */ @endphp

@foreach ($action->getRows() as $model)

    <li class="{{ $action->theme('index.list.row') }}">

        @foreach ($action->getFields() as $field)

            <div class="{{ $field->getClass($action->theme('index.list.field')) }}">

                {!! view($field->getView(), compact(['action']), ['field' => $field->with($model)]) !!}

            </div>

        @endforeach

        <div class="{{ $action->theme('index.list.invokers.container') }}">

            @if ($action->theme('views.invokers'))

                @include ($action->theme('views.invokers'))

            @else

                @include ('authanram-resources::actions.invokers')

            @endif

        </div>

    </li>

@endforeach
