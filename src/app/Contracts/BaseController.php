<?php

namespace App\Contracts;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface BaseController
{
    public function handle(Request $request): JsonResponse;
}
