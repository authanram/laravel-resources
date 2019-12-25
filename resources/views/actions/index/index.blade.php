@php /** @var \Resources\Http\Actions\IndexAction $action */ @endphp

@extends ('resources::actions.index', [

    'action' => $action,

])

@section ('resources.content')

    <ul class="{{ $action->theme('card') }}">

        @include ('resources::actions.index.header')

        @include ('resources::actions.index.rows')

    </ul>

    <div class="flex justify-end">

        @include ('resources::actions.pagination')

    </div>

@endsection
