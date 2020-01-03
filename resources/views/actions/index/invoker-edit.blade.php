@php /** @var \Authanram\Resources\Http\Actions\IndexAction $action */ @endphp

<a
    class="{{ $action->theme(['resources.buttons.button', 'resources.buttons.size.sm', 'resources.buttons.variants.primary']) }}"

    href="{{ $action->getRoutes()->makeRoute('edit', $model->id) }}"

    {{ $attributes ?? '' }}
>

    {{ $action->getInvokers()->first()->label }}

</a>
