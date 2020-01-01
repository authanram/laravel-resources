<?php

namespace Authanram\Resources\Http\Actions\Concerns;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Validation\Validator;
use Authanram\Resources\Entities\Action;

trait ValidatesInput
{
    private function validate(array $input): ?RedirectResponse
    {
        $validator = $this->makeValidator($input, $this->getValidationRules());

        if (! $validator->fails()) {

            return null;

        }

        return Redirect::back()

            ->withErrors($validator)

            ->withInput();
    }

    private function getValidationRules(): array
    {
        $actions = [Action::STORE => Action::CREATE, Action::UPDATE => Action::EDIT];

        $action = $actions[$this->action];

        $validationRules = data_get($this->getRawResource(), "actions.$action.validators");

        return $this->mergeValidationRules($action, collect($validationRules));
    }

    private function makeValidator(array $input, array $validationRules): Validator
    {
        return ValidatorFacade::make($input, $validationRules);
    }

    private function mergeValidationRules(string $action, Collection $validationRules): array
    {
        if (Action::EDIT !== $action) {

            return $validationRules->toArray();

        }

        $createActionValidationRules = data_get($this->getRawResource(), 'actions.create.validators');

        $validationRulesDiff = collect($createActionValidationRules)->diffKeys($validationRules);

        $validationRules = $validationRules->merge($validationRulesDiff);

        return $validationRules->toArray();
    }
}
