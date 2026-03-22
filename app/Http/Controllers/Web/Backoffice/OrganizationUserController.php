<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Backoffice;

use App\Actions\OrganizationUser\AddOrganizationUserAction;
use App\Actions\OrganizationUser\ListOrganizationUsersAction;
use App\Actions\OrganizationUser\RemoveOrganizationUserAction;
use App\Actions\OrganizationUser\UpdateOrganizationUserRoleAction;
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
    public function index(ListOrganizationUsersAction $action, Organization $organization): Response
    {
        $data = $action->execute($organization);

        return Inertia::render('ManageOrganizationUsers', $data);
    }

    public function store(AddOrganizationUserAction $action, Organization $organization, User $user): RedirectResponse
    {
        try {
            $action->execute($organization, $user);
            return Redirect::back()->with('success', 'User has been added to the organization.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }

    public function update(UpdateOrganizationMemberRequest $request, UpdateOrganizationUserRoleAction $action, Organization $organization, User $user): RedirectResponse
    {
        $role = $request->validated('role');

        try {
            $action->execute($organization, $user, $role);
            return Redirect::back()->with('success', 'User role has been updated.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }

    public function destroy(RemoveOrganizationUserAction $action, Organization $organization, User $user): RedirectResponse
    {
        try {
            $action->execute($organization, $user);
            return Redirect::back()->with('success', 'User has been removed from the organization.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }
}
