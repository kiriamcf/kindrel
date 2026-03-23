<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Backoffice;

use App\Actions\OrganizationUser\AddUser;
use App\Actions\OrganizationUser\ListUsers;
use App\Actions\OrganizationUser\RemoveUser;
use App\Actions\OrganizationUser\UpdateUserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateOrganizationMemberRequest;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class OrganizationUserController extends Controller
{
    public function index(ListUsers $action, Organization $organization): Response
    {
        $data = $action->execute($organization)->toArray();

        return Inertia::render('ManageOrganizationUsers', $data);
    }

    public function store(AddUser $action, Organization $organization, User $user): RedirectResponse
    {
        try {
            $action->execute($organization, $user);
            return Redirect::back()->with('success', 'User has been added to the organization.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }

    public function update(UpdateOrganizationMemberRequest $request, UpdateUserRole $action, Organization $organization, User $user): RedirectResponse
    {
        $role = $request->validated('role');

        try {
            $action->execute($organization, $user, $role);
            return Redirect::back()->with('success', 'User role has been updated.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }

    public function destroy(RemoveUser $action, Organization $organization, User $user): RedirectResponse
    {
        try {
            $action->execute($organization, $user);
            return Redirect::back()->with('success', 'User has been removed from the organization.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }
}
