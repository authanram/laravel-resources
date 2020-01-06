@php /** @var \Authanram\Resources\Entities\Fields\Output\Timestamp $field */ @endphp
@php /** @var \Authanram\Resources\Http\Actions\Action $action */ @endphp

<p class="{{ $action->theme(['resources.fields', 'default', 'types.timestamp.container']) }}">

    @if ($field->isDiffForHumans())

        {{ $field->getValue() }}

    @else

        {{ $field->getDate() }}<p class="{{ $action->theme('resources.fields.types.timestamp.time.container') }}">,</p>&nbsp;

            <p class="{{ $action->theme(['resources.fields.types.timestamp.time', 'container', 'value']) }}">

                {{ $field->getTime() }}

            </p>

    @endif

</p>
