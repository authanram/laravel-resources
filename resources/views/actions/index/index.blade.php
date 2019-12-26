@php /** @var \Resources\Http\Actions\IndexAction $action */ @endphp

@extends ('authanram-resources::actions.index', [

    'action' => $action,

])

@section ('resources.content')

    <ul class="{{ $action->theme('card') }}">

        @include ('authanram-resources::actions.index.header')

        @include ('authanram-resources::actions.index.rows')

    </ul>

    <div class="flex justify-end">

        @include ('authanram-resources::actions.pagination')

    </div>

@endsection
