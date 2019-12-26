<?php

namespace Authanram\Resources\Http\Actions;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Authanram\Resources\Entities;

class StoreAction extends Action
{
    use Concerns\MakesRedirectResponse;
    use Concerns\MakesFlashMessages;
    use Concerns\StoresInput;
    use Concerns\ValidatesInput;

    protected string $action = Entities\Action::STORE;

    public function run(Request $request): RedirectResponse
    {
        $this->handle($request);

        $input = $request->input();

        $validationResult = $this->validate($input);

        if ($validationResult) {

            $this->flashError($this, $request);

            return $validationResult;

        }

        $this->save($input);

        $this->syncManyToManyAssociations($input);

        return $this->makeRedirectResponse($this, $request);
    }
}
