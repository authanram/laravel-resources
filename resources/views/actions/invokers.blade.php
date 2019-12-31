@php /** @var \Authanram\Resources\Http\Actions\IndexAction $action */ @endphp

<a
    class="{{ $action->theme('buttons.button', 'buttons.size.sm', 'buttons.accents.primary', 'actions.index.invokers.invoker') }}"

    href="{{ $action->getRoutes()->makeRoute('edit', $model->id) }}"

    {{ $action->theme('buttons.directives') }}
>

    {{ $action->getInvokers()->first()->label }}

</a>
