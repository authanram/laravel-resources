@php /** @var \Authanram\Resources\Http\Actions\Action $action */ @endphp

@if ($action->getBreadcrumbs())

    @foreach ($action->getBreadcrumbs() as $breadcrumb)

        <div class="{{ $action->theme('resources.breadcrumbs.item.' . ($loop->last ? 'last' : 'default')) }}">

            <a
                class="{{ $action->theme(['resources.link', 'default', $loop->last ? 'accent' : null]) }}"

                href="{{ $breadcrumb->get('url') }}"
            >{!!

                sprintf(
                    $breadcrumb->get('text'),
                    '"<span class="'.$action->theme('resources.breadcrumbs.item.highlight').'">',
                    '</span>"'
                )

            !!}</a>

            @if (!$loop->last)

                &nbsp;/&nbsp;

            @endif

        </div>

    @endforeach

@endif
