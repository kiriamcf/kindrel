<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\OrgRequestStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrganizationUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        // TODO: add proper authorization logic (e.g., organization manager access)
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => [
                'required',
                'string',
                'in:' . OrgRequestStatus::APPROVED->value . ',' . OrgRequestStatus::REJECTED->value,
            ],
        ];
    }
}
