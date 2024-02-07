<?php

namespace App\Models;

use App\Enums\TodoProviders;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * To do Model
 */
class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'provider',
        'points',
        'estimated_duration',
        'developer_id',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id'                 => 'int',
        'name'               => 'string',
        'provider'           => TodoProviders::class,
        'points'             => 'int',
        'estimated_duration' => 'int',
        'developer_id'       => 'int',
        'updated_at'         => 'datetime',
        'created_at'         => 'datetime',
    ];

    /**
     * @return BelongsTo
     */
    public function developer(): BelongsTo
    {
        return $this->belongsTo(Developer::class);
    }
}
