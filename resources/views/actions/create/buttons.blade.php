@php /** @var \Authanram\Resources\Http\Actions\EditAction $action */ @endphp

@include ('authanram-resources::actions.form.buttons', [
    'primary' => [
        'label' => __('Create & Add Another'),
        'value' => 'create',
    ],
    'secondary' => [
        'label' => __('Create') . ' ' . $action->getResourceName(),
    ],
])
