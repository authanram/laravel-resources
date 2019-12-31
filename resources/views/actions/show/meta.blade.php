@php /** @var \Authanram\Resources\Entities\Fields\BaseField $field */ @endphp
@php /** @var \Authanram\Resources\Http\Actions\IndexAction $action */ @endphp

<h2 class="{{ $action->theme('actions.show.meta.title') }}">

    {{ __('Meta') }}

</h2>

<div class="{{ $action->theme('card') }}">

    <div class="{{ $action->theme('actions.show.container') }}">

        @include ('authanram-resources::actions.show.fields', ['fields' => $action->getMetaFields()])

    </div>

</div>
