@php /** @var \Authanram\Resources\Http\Actions\EditAction $action */ @endphp

@include ('authanram-resources::actions.form.buttons', [
    'primary' => [
        'label' => __('Update & Continue Editing'),
        'value' => 'edit',
    ],
    'secondary' => [
        'label' => __('Update') . ' ' . $action->getResourceName(),
    ],
])
