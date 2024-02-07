<?php

namespace App\Console\Commands;

use App\Services\TodoService\TodoService;
use Illuminate\Console\Command;

/**
 * To do Providers command
 */
class TodoProviders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'todo:providers';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Provider 2 Command';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $todos       = config('todo.todos');
        $todoService = new TodoService();
        collect($todos)->map(function (string $todo) use ($todoService)
        {
            $todoService->insertProvider($todo);
        });
    }
}
