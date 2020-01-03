@php /** @var \Authanram\Resources\Http\Actions\IndexAction $action */ @endphp

@extends ('authanram-resources::actions.index', [

    'action' => $action,

])

@section ('resources.content')

    @include ('authanram-resources::actions.index.header')

    @foreach ($action->getRows() as $model)

        @include ('authanram-resources::actions.index.row')

    @endforeach

@endsection

@section ('resources.pagination')

    @include ('authanram-resources::actions.index.pagination')

@endsection
