@php /** @var \Authanram\Resources\Http\Actions\Action $action */ @endphp

@if ($action->getBreadcrumbs())

    <div class="{{ $action->theme('breadcrumbs') }}">

        @foreach ($action->getBreadcrumbs() as $breadcrumb)

            <a
                href="{{ $breadcrumb->get('url') }}"

                class="{{ $action->theme('link.default', !$loop->last ?: 'link.accent') }}"
            >{!!

                sprintf($breadcrumb->get('text'), '<strong>', '</strong>')

            !!}</a>

            @if (!$loop->last)

                &nbsp;/&nbsp;

            @endif

        @endforeach

    </div>

@endif
