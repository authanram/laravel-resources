@php /** @var \Authanram\Resources\Http\Actions\EditAction $action */ @endphp

@extends ('authanram-resources::actions.index', [

    'action' => $action,

])

@section ('resources.content')

    @include ('authanram-resources::actions.form.index', [

        'buttonsView' => 'authanram-resources::actions.edit.buttons',

        'postAction' => $action->getRoutes()->getUpdateUrl(),

    ])

@endsection
