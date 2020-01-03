@php /** @var \Authanram\Resources\Entities\Fields\Input\BelongsToMany $field */ @endphp
@php /** @var \Authanram\Resources\Http\Actions\Action $action */ @endphp

<select
    class="{{ $action->theme('resources.form.fields.field.input') }}"

    name="{{ $field->getAttribute() }}[]"

    multiple
>

    @foreach ($field->getAssociation() as $label => $id)

        <option
            value="{{ $id }}"

            {{ $field->isSelected($id) ? 'selected="selected"' : '' }}
        >

            {{ $label }}

        </option>

    @endforeach

</select>
