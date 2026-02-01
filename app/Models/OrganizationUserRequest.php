<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\OrgRequestStatus;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrganizationUserRequest extends Pivot
{
    protected $table = 'organization_user_requests';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'organization_id',
        'user_id',
        'status',
    ];

    protected $casts = [
        'status' => OrgRequestStatus::class,
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