@php /** @var \Resources\Http\Actions\EditAction $action */ @endphp

@extends ('resources::actions.index', [

    'action' => $action,

])

@section ('resources.content')

    <form
        action="{{ $action->getRoutes()->getStoreUrl() }}"

        method="POST"
    >

        @include ('resources::actions.form.index', [

            'actions' => 'resources::actions.create.buttons',

        ])

    </form>

@endsection
