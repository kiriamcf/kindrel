<?php 

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'species',
        'breed',
        'age',
        'arrival_date',
    ];

    /**
     * @return array<string, string>
     */
    protected $casts = [
        'age' => 'integer',
        'arrival_date' => 'datetime',
    ];
}
