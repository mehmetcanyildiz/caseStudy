<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

/**
 * Responder Helper
 */
class Responder
{
    /**
     * Base response model.
     *
     * @var array<string, mixed>
     */
    protected static array $responseModel = [
        'success' => null,
        'error'   => null,
        'meta'    => null,
        'data'    => null,
    ];

    /**
     * Returns success response.
     *
     * @param ?array $data
     * @param ?array $meta
     *
     * @return JsonResponse
     */
    public static function success(
        ?array $data = null,
        ?array $meta = null,
    ): JsonResponse {
        $response = self::$responseModel;

        $response['success'] = true;
        $response['meta']    = $meta;
        $response['data']    = $data;

        return Response::json($response);
    }

    /**
     * Returns error response.
     *
     * @param ?int    $errorCode
     * @param ?string $errorMessage
     * @param int     $httpStatusCode
     *
     * @return JsonResponse
     */
    public static function error(
        ?int $errorCode = null,
        ?string $errorMessage = null,
        int $httpStatusCode = 400,
    ): JsonResponse {
        $response = self::$responseModel;

        $response['success'] = false;

        $response['error'] = [
            'code'    => $errorCode,
            'message' => $errorMessage,
        ];

        return Response::json($response, $httpStatusCode);
    }
}
