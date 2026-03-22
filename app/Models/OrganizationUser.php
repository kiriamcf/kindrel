<?php declare(strict_types=1);

namespace App\Models;

use App\Enums\OrgRole;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrganizationUser extends Pivot
{
    protected $table = 'organization_user';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'organization_id',
        'user_id',
        'role',
    ];

    protected $casts = [
        'status' => OrgRole::class,
    ];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}