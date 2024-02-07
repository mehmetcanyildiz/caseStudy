<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Developer Model
 */
class Developer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'level',
        'first_available_at',
        'total_assign_hour',
    ];
    protected $casts    = [
        'name'               => 'string',
        'level'              => 'int',
        'first_available_at' => 'timestamp',
        'total_assign_hour'  => 'float',
    ];

    /**
     * @return HasMany
     */
    public function todos(): HasMany
    {
        return $this->hasMany(Todo::class);
    }
}
