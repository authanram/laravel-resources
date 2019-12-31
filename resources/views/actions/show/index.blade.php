@php /** @var \Authanram\Resources\Entities\Fields\BaseField $field */ @endphp
@php /** @var \Authanram\Resources\Http\Actions\IndexAction $action */ @endphp

@extends ('authanram-resources::actions.index', [

    'action' => $action,

])

@section ('resources.content')

    <div class="{{ $action->theme('card') }}">

        <div class="{{ $action->theme('actions.show.container') }}">

            @include ('authanram-resources::actions.show.fields', ['fields' => $action->getFields()])

        </div>

    </div>

    @include ('authanram-resources::actions.show.meta')

@endsection
