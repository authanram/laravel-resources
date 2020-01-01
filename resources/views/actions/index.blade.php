@php /** @var \Authanram\Resources\Http\Actions\EditAction $action */ @endphp

@extends ($action->theme('views.layout.view'))

@section (config('authanram-resources.development.dump.section'))

    @if (app()->environment('local') && request()->input(config('authanram-resources.development.dump.parameter')))

        @dump ($action->dump(request()->input(config('authanram-resources.development.dump.parameter'))))

    @endif

@endsection

@section ($action->theme('views.layout.sections.breadcrumbs'))

    @include ('authanram-resources::actions.breadcrumbs')

@endsection

@section ($action->theme('views.layout.sections.flash'))

    @include ('authanram-resources::actions.flash')

@endsection

@section ($action->theme('views.layout.sections.content'))

    <div class="{{ $action->theme('content') }}">

        @yield ('resources.content')

    </div>

@endsection
