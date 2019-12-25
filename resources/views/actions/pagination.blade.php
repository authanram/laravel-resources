@php /** @var \Resources\Http\Actions\IndexAction $action */ @endphp

{{ $action->getLengthAwarePaginator()->links() }}
