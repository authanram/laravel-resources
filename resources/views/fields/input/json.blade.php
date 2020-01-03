@php /** @var \Authanram\Resources\Entities\Fields\Input\Json $field */ @endphp
@php /** @var \Authanram\Resources\Http\Actions\Action $action */ @endphp

<textarea
    class="{{ $action->theme('resources.form.fields.field.input') }}"

    name="{{ $field->getAttribute() }}"
>{{

    $field->getValue()

}}</textarea>
