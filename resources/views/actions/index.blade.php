@php /** @var \Authanram\Resources\Http\Actions\EditAction $action */ @endphp

@extends ($action->theme('resources.views.layout.view', 'authanram-resources::layout'))

@section (config('authanram-resources.development.dump.section'))

    @if (app()->environment('local') && request()->input(config('authanram-resources.development.dump.parameter')))

        @dump ($action->dump(request()->input(config('authanram-resources.development.dump.parameter'))))

    @endif

@endsection

@section ($action->theme('resources.views.layout.sections.breadcrumbs', 'breadcrumbs'))

    @include ('authanram-resources::actions.breadcrumbs')

@endsection

@section ($action->theme('resources.views.layout.sections.flash', 'flash'))

    @include ('authanram-resources::actions.flash')

@endsection

@section ($action->theme('resources.views.layout.sections.content', 'content'))

    @yield ('resources.content')

@endsection

@section ($action->theme('resources.views.layout.sections.meta', 'meta'))

    @yield ('resources.meta')

@endsection

@section ($action->theme('resources.views.layout.sections.pagination', 'pagination'))

    @yield ('resources.pagination')

@endsection
