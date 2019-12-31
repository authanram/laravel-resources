@php /** @var \Authanram\Resources\Http\Actions\EditAction $action */ @endphp
@php /** @var \Authanram\Resources\Entities\Fields\BaseField $field */ @endphp

@foreach ($action->getFields() as $field)

    <div class="{{ $field->getClass($action->getAction()) }}">

        <label class="{{ $action->theme(null) }}">

                <span class="{{ $action->theme(null) }}">

                    {{ $field->getLabel() }}

                </span>

            {!! view($field->getView(), [

                'action' => $action,

                'field' => $field->with($action->getModel())

            ]) !!}

        </label>

    </div>

@endforeach
