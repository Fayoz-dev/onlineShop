<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function response($date): JsonResponse
    {
        return response()->json([
            'success' => true,
            'date' => $date,
        ]);
    }

    public function error(string $message, array $data = null): JsonResponse
    {
        return response()->json([
            'success' => false,
            'status' => 'error',
            'message' => $message ?? 'error accured',
            'date' => $data,
        ]);
    }

    public function success(string $message = null, array $date = null): JsonResponse
    {
        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => $message ?? 'operation success',
            'date' => $date,
        ]);
    }
}
