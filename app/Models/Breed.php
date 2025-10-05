<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Breed extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'species_id',
    ];

    /**
     * @return array<string, string>
     */
    protected $casts = [
        'species_id' => 'integer',
    ];

    public function species(): BelongsTo
    {
        return $this->belongsTo(Species::class);
    }
}
