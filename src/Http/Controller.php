<?php

namespace Light\Http;

use Light\Http\Response\Response;

interface Controller
{
    public function handle(Request $request) : Response;
}
