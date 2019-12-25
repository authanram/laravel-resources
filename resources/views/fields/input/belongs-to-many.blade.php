@php /** @var \Resources\Entities\Fields\Input\BelongsToManyEntity $field */ @endphp

<select
    class="{{ $action->theme('form.fields.field.input') }}"

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
