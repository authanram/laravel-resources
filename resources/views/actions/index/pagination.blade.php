@php /** @var \Authanram\Resources\Http\Actions\IndexAction $action */ @endphp

@if ($action->getLengthAwarePaginator()->hasPages())

    @php ($urlRange = $action->getLengthAwarePaginator()->getUrlRange(1, ($action->getLengthAwarePaginator()->lastPage())))

    @php ($currentPage = $action->getLengthAwarePaginator()->currentPage())

    <div class="flex justify-end">

        @foreach ($urlRange as $key => $url)

            <a
                class="{{ $action->theme([

                    'resources.buttons.button',
                    'resources.buttons.size.sm',
                    'resources.buttons.variants.' . ($currentPage === $loop->index+1 ? 'primary' : 'tertiary')

                ]) }}"

                href="{{ $url }}"
            >

                {{ $key }}

            </a>


            @if (! $loop->last)

                <span class="{{ $action->theme('resources.spacer.default') }}"></span>

            @endif

        @endforeach

    </div>

@endif
