@php /** @var \Authanram\Resources\Http\Actions\EditAction $action */ @endphp

@extends (config('authanram-resources.views.extends'))

@section (config('authanram-resources.development.dump.section'))

    @if (take(request()->input(config('authanram-resources.development.dump.parameter')))->getIfLocal())

        @dump ($action->dump(request()->input(config('authanram-resources.development.dump.parameter'))))

    @endif

@endsection

@section (config('authanram-resources.views.sections.breadcrumbs'))

    @include ('authanram-resources::actions.breadcrumbs')

@endsection

@section (config('authanram-resources.views.sections.content'))

    <div class="{{ $action->theme('content') }}">

        @yield ('resources.content')

    </div>

@endsection
