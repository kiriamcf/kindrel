<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class OrganizationUserController extends Controller
{
    public function list(): Response
    {
        return Inertia::render('RequestOrganizationAccess');
    }
}