<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Animal extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'species_id',
        'breed_id',
        'age',
        'arrival_date',
    ];

    /**
     * @return array<string, string>
     */
    protected $casts = [
        'age' => 'integer',
        'species_id' => 'integer',
        'breed_id' => 'integer',
        'arrival_date' => 'datetime',
    ];

    public function species(): BelongsTo
    {
        return $this->belongsTo(Species::class);
    }

    public function breed(): BelongsTo
    {
        return $this->belongsTo(Breed::class);
    }
}
