<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Responder;
use App\Http\Controllers\Controller;
use App\Http\Resources\DeveloperResource;
use App\Services\TodoService\TodoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * TodoController
 */
class TodoController extends Controller
{
    /**
     * @param TodoService $todoService
     *
     * @return JsonResponse
     */
    public function index(TodoService $todoService): JsonResponse
    {
        return Responder::success([
            'developers' => DeveloperResource::collection($todoService->getPlans()),
        ]);
    }
}
