@php /** @var \Authanram\Resources\Entities\Fields\BaseField $field */ @endphp
@php /** @var \Authanram\Resources\Http\Actions\Action $action */ @endphp

@php ($typeWrapperTagNames = [
    'belongsTo' => 'div',
    'froala' => 'div',
])

<{{ $typeWrapperTagNames[$field->getType()] ?? 'label' }}
    class="{{ $action->theme('resources.form.fields.label.container') }}"
>

    <span class="{{ $action->theme('resources.form.fields.label.text') }}">

        {{ $field->getLabel() }}

    </span>

    {!! view($field->getView(), [

        'action' => $action,

        'field' => $field->with($action->getModel())

    ]) !!}

    @include ('authanram-resources::fields.error')

</{{ $typeWrapperTagNames[$field->getType()] ?? 'label' }}>
