<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait HasResponse
{
    /**
     * Return response to users.
     *
     * @param bool $success
     * @param string $message
     * @param mixed $data
     * @param int $code
     * @return JsonResponse
     */
    public function sendResponse(bool $success, string  $message, mixed $data = [], int $code = 200): JsonResponse
    {
        return response()->json(
            [
                'success' => $success,
                'message' => $message,
                'data' => $data
            ],
            $code
        );
    }
}
