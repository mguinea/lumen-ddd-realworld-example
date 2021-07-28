<?php

namespace Apps\BlogApi\App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected array $parameters;
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->parameters = $request->all();
        $this->request = $request;
    }

    public function parameters(): Request
    {
        return $this->request->replace($this->parameters);
    }

    /*
    protected function filters(Request $request, array $filters = []): array
    { // TODO move to class with toArray
        $response = [];

        foreach ($filters as $filter) {
            if (true === $request->has($filter['field'])) {
                $response[] = [
                    'field' => $filter['field'],
                    'operator' => true === array_key_exists(
                        'operator',
                        $filter
                    ) ? $filter['operator'] : '=',
                    'value' => $request->input($filter['field'])
                ];
            }
        }

        return $response;
    }
    //*/
}
