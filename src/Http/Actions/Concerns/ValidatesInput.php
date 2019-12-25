<?php

namespace Resources\Http\Actions\Concerns;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Validation\Validator;
use Resources\Entities\Action;

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

        $validationRules = take($this->getRawResource(), "actions.$action.validators")->toCollection();

        return $this->mergeValidationRules($action, $validationRules);
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

        $createActionValidationRules = take($this->getRawResource(), 'actions.create.validators')->toCollection();

        $validationRulesDiff = $createActionValidationRules->diffKeys($validationRules);

        $validationRules = $validationRules->merge($validationRulesDiff);

        return $validationRules->toArray();
    }
}
