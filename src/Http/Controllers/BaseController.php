<?php

declare(strict_types=1);

namespace Light\Http\Controllers;

use Light\ {
    Http\Controller,
    Http\Request
};

use Light\Validation\Validator;

abstract class BaseController implements Controller
{
    public function __construct(private Validator $validator)
    {
    }

    /**
     * @param  Request  $request
     * @param  mixed[]  $rules
     *
     * @return string[][]
     * @throws \Exception
     */
    protected function validateRequest(Request $request, array $rules) : array
    {
        return $this->validator->validate($request->getData(), $rules);
    }
}
