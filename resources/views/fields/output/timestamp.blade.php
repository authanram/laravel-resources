@php /** @var \Resources\Http\Actions\Action $action */ @endphp
@php /** @var \Resources\Entities\Fields\Output\TimestampEntity $field */ @endphp

<span class="{{ $action->theme('fields.timestamp.container') }}">

    @if ($field->isDiffForHumans())

        {{ $field->getValue() }}

    @else

        {{ $field->getDate() }}<span class="{{ $action->theme('fields.timestamp.time.container') }}">,</span>

            <span class="{{ $action->theme('fields.timestamp.time.container', 'fields.timestamp.time.value') }}">

                {{ $field->getTime() }}

            </span>

    @endif

</span>
