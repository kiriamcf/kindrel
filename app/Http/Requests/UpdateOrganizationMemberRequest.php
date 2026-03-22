<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\OrgRole;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrganizationMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        // TODO: enforce organization admin/owner permissions
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'role' => [
                'required',
                'string',
                'in:' . implode(',', array_map(fn(OrgRole $role) => $role->value, OrgRole::cases())),
            ],
        ];
    }
}
