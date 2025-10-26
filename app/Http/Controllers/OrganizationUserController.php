<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Organization;
use Inertia\Inertia;
use Inertia\Response;

class OrganizationUserController extends Controller
{
    public function list(): Response
    {
        $organizations = Organization::paginate(12);

        return Inertia::render('RequestOrganizationAccess', [
            'organizations' => $organizations,
        ]);
    }
}
