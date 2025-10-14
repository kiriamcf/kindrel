<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Species extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'scientific_name',
        'icon',
    ];

    public function breeds(): HasMany
    {
        return $this->hasMany(Breed::class);
    }

    public function animals(): HasMany
    {
        return $this->hasMany(Animal::class);
    }
}
