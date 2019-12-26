<?php

namespace Authanram\Resources\Http\Actions;

use Illuminate\Http\Request;
use Authanram\Resources\Entities;

final class IndexAction extends Action
{
    protected string $action = Entities\Action::INDEX;

    protected string $view = 'authanram-resources::actions.index.index';

    protected array $rows;

    public function handle(Request $request): Action
    {
        parent::handle($request);

        $this->rows = $this->getLengthAwarePaginator()->items();

        return $this;
    }

    public function getRows(): array
    {
        return $this->rows;
    }
}
