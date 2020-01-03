@php /** @var \Authanram\Resources\Entities\Fields\BaseField $field */ @endphp
@php /** @var \Authanram\Resources\Http\Actions\IndexAction $action */ @endphp

<h2 class="{{ $action->theme('resources.actions.show.meta.title') }}">

    {{ __('Meta') }}

</h2>

<div class="{{ $action->theme('resources.card') }}">

    @foreach ($action->getMetaFields() as $field)

        @include ('authanram-resources::actions.show.field')

    @endforeach

</div>
