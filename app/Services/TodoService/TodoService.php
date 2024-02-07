<?php

namespace App\Services\TodoService;

use App\Exceptions\TodoServiceException;
use App\Exceptions\InsertProviderException;
use App\Models\Developer;
use App\Models\Todo;
use App\Services\TodoService\DTO\TodoItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as CollectionAlias;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * TodoService
 */
class TodoService
{
    /**
     * @param string $todoProvider
     *
     * @return JsonResponse|Collection
     * @throws TodoServiceException
     */
    public function insertProvider(string $todoProvider): JsonResponse|Collection
    {
        try {
            $adapter = TodoServiceManager::getTodoServiceAdapter($todoProvider);
            $todos   = $adapter->getTodos();

            return $todos->getItems()->map(function (TodoItem $todo)
            {
                $todoModel = Todo::query()->where('name', $todo->name)
                                 ->where('provider', $todo->provider)
                                 ->first();

                if (empty($todoModel)) {
                    $todoModel = new Todo();
                }
                $todoModel->fill($todo->toModelArray());

                return $todoModel->save();
            });
        } catch (Throwable) {
            throw new TodoServiceException(message: 'InsertProviderException', code: 1000);
        }
    }

    /**
     * @param int $points
     *
     * @return Builder|Model|JsonResponse|null
     * @throws TodoServiceException
     */
    private function findDeveloper(int $points): Model|Builder|JsonResponse|null
    {
        try {
            return Developer::query()
                            ->select(DB::raw(sprintf('*,%s/level as new_points', $points)))
                            ->orderBy('total_assign_hour')
                            ->orderBy('new_points')
                            ->first();
        } catch (Throwable) {
            throw new TodoServiceException(message: 'FindDeveloperException', code: 1001);
        }
    }

    /**
     * Update developers for todos without assigned developers.
     *
     * @return JsonResponse|CollectionAlias
     * @throws TodoServiceException
     */
    public function updateTodoDevelopers(): JsonResponse|CollectionAlias
    {
        try {
            return Todo::query()->whereNull('developer_id')->get()->map(function (Todo $todo)
            {
                $developer = $this->findDeveloper($todo->estimated_duration * $todo->points);

                if ($developer === null) {
                    return $todo;
                }

                $todo->developer_id = $developer->id;
                $todo->save();

                $developer->total_assign_hour += ($todo->estimated_duration * $todo->points) / $developer->level;
                $developer->save();

                return $todo;
            });
        } catch (Throwable) {
            throw new TodoServiceException(message: 'UpdateTodoDeveloperException', code: 1002);
        }
    }

    /**
     * Get plans for developers.
     *
     * @return CollectionAlias|Builder[]
     * @throws TodoServiceException
     */
    public function getPlans(): JsonResponse|Collection
    {
        try {
            return Developer::query()->select(
                DB::raw(sprintf('*,total_assign_hour/%s as total_week', config('todo.weekHours')))
            )->get();
        } catch (Throwable) {
            throw new TodoServiceException(message: 'GetPlanException', code: 1003);
        }
    }
}
