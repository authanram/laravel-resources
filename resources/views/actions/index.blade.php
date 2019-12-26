@php /** @var \Resources\Http\Actions\EditAction $action */ @endphp

@extends (config('resources.views.extends'))

@section (config('resources.development.dump.section'))

    @if (take(request()->input(config('resources.development.dump.parameter')))->getIfLocal())

        @dump ($action->dump(request()->input(config('resources.development.dump.parameter'))))

    @endif

@endsection

@section (config('resources.views.sections.breadcrumbs'))

    @include ('resources::actions.breadcrumbs')

@endsection

@section (config('resources.views.sections.content'))

    <div class="{{ $action->theme('content') }}">

        @yield ('resources.content')

    </div>

@endsection
