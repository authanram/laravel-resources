@php /** @var \Resources\Http\Actions\EditAction $action */ @endphp

@extends ('authanram-resources::actions.index', [

    'action' => $action,

])

@section ('resources.content')

    <form
        action="{{ $action->getRoutes()->getStoreUrl() }}"

        method="POST"
    >

        @include ('authanram-resources::actions.form.index', [

            'actions' => 'authanram-resources::actions.create.buttons',

        ])

    </form>

@endsection
