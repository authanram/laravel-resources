@php /** @var \Authanram\Resources\Http\Actions\IndexAction $action */ @endphp

<a href="{{ $action->getRoutes()->makeRoute('edit', $model->id) }}">

    {{ $action->getInvokers()->first()->label }}

</a>
