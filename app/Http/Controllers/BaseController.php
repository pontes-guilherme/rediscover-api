<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BaseController extends Controller
{
    protected function success(
        string $message = null,
        array  $data = [],
        int    $httpCode = 200
    ): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
        ], $httpCode);
    }

    protected function error(
        string $message = null,
        array  $errors = [],
        int    $httpCode = 500
    ): JsonResponse
    {
        return response()->json([
            'status' => $httpCode,
            'errors' => $errors,
            'detail' => $message,
        ], $httpCode);
    }

    protected function noContent(): Response
    {
        return response()->noContent();
    }
}
