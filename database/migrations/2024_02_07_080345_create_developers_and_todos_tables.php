<?php

use App\Enums\TodoProviders;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Create Developers And Todos Tables
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->createDevelopersTable();
        $this->createTodosTable();
        $this->addForeignKeys();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('todos', function (Blueprint $table): void
        {
            $table->dropForeign(['developer_id']);
        });

        Schema::dropIfExists('todos');
        Schema::dropIfExists('developers');
    }

    /**
     * Create the developers table.
     */
    private function createDevelopersTable(): void
    {
        Schema::create('developers', function (Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('name', 191)->index();
            $table->unsignedTinyInteger('level')->default(0)->comment('level of developer');
            $table->timestamp('first_available_at')->nullable();
            $table->unsignedDecimal('total_assign_hour')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Create the todos table.
     */
    private function createTodosTable(): void
    {
        Schema::create('todos', function (Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->enum('provider', TodoProviders::values())->index();
            $table->unsignedBigInteger('developer_id')->nullable()->index();
            $table->string('name', 191)->index();
            $table->unsignedTinyInteger('points');
            $table->unsignedTinyInteger('estimated_duration');
            $table->timestamps();
        });
    }

    /**
     * Add foreign keys.
     */
    private function addForeignKeys(): void
    {
        Schema::table('todos', function (Blueprint $table): void
        {
            $table->foreign('developer_id')->references('id')->on('developers');
        });
    }
};
