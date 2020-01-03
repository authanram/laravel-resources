@php /** @var \Authanram\Resources\Entities\Fields\BaseField $field */ @endphp
@php /** @var \Authanram\Resources\Http\Actions\IndexAction $action */ @endphp

@extends ('authanram-resources::actions.index', [

    'action' => $action,

])

@section ('resources.content')

    @foreach ($action->getFields() as $field)

        @include ('authanram-resources::actions.show.field')

    @endforeach

@endsection

@section ('resources.meta')

    @include ('authanram-resources::actions.show.meta')

@endsection
