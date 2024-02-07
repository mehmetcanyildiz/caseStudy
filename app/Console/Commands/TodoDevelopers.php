<?php

namespace App\Console\Commands;

use App\Services\TodoService\TodoService;
use Illuminate\Console\Command;

/**
 * To do Developers command
 */
class TodoDevelopers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'todo:developers';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Provider 1 Command';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $todoService = new TodoService();
        $todoService->updateTodoDevelopers();
    }
}
