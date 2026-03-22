<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Backoffice;

use App\Enums\OrgRole;
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
    public function index(Organization $organization): Response
    {
        $users = $organization->users()
            ->withPivot('role')
            ->get()
            ->map(function (User $user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->pivot->role,
                    'created_at' => $user->pivot->created_at,
                    'updated_at' => $user->pivot->updated_at,
                ];
            });

        return Inertia::render('ManageOrganizationUsers', [
            'users' => $users,
            'organization' => $organization,
        ]);
    }

    public function store(Organization $organization, User $user): RedirectResponse
    {
        if ($organization->users()->where('user_id', $user->id)->exists()) {
            return Redirect::back()
                ->with('error', 'User is already a member of this organization.');
        }

        $organization->users()->attach($user->id, [
            'role' => OrgRole::MEMBER->value,
        ]);

        return Redirect::back()
            ->with('success', 'User has been added to the organization.');
    }

    public function update(UpdateOrganizationMemberRequest $request, Organization $organization, User $user): RedirectResponse
    {
        $role = $request->validated('role');

        $organization->users()->updateExistingPivot($user->id, [
            'role' => $role,
        ]);

        return Redirect::back()
            ->with('success', 'User role has been updated.');
    }

    public function destroy(Organization $organization, User $user): RedirectResponse
    {
        $organization->users()->detach($user->id);

        return Redirect::back()
            ->with('success', 'User has been removed from the organization.');
    }
}
