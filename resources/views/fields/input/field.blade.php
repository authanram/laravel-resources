@php /** @var \Resources\Entities\Fields\BaseField $field */ @endphp
@php /** @var \Resources\Http\Actions\Action $action */ @endphp

<label class="{{ $action->theme('form.label.container') }}">

    <span class="{{ $action->theme('form.label.text') }}">

        {{ $field->getLabel() }}

    </span>

    {!! view($field->getView(), [

        'action' => $action,

        'field' => $field->with($action->getModel())

    ]) !!}

    @include ('resources::fields.error')

</label>
