<?php

namespace App\Http;

use App\Http\Response\Response;

interface Controller
{
    public function handle(Request $request) : Response;
}
