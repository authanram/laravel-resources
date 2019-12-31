@php /** @var \Authanram\Resources\Http\Actions\EditAction $action */ @endphp
@php /** @var \Authanram\Resources\Entities\Fields\BaseField $field */ @endphp

@foreach ($fields as $field)

    <div class="{{ $field->getClass($action->getAction(), $action->theme('actions.show.row')) }}">

        <label class="{{ $action->theme('actions.show.fields.label.container') }}">

            <span class="{{ $action->theme('actions.show.fields.label') }}">

                {{ $field->getLabel() }}

            </span>

            <span class="{{ $action->theme('actions.show.fields.label.field') }}">

                {!! view($field->getView(), [

                    'action' => $action,

                    'field' => $field->with($action->getModel())

                ]) !!}

            </span>

        </label>

    </div>

    @if (! $loop->last)

        <div class="w-full">

            <div class="border-t"></div>

        </div>

    @endif

@endforeach
