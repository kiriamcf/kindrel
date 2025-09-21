<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;
use App\Http\Resources\OrganizationResource;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrganizationController extends Controller
{
    public function list()
    {
        // 
    }

    public function index(): AnonymousResourceCollection
    {
        return OrganizationResource::collection(Organization::paginate(100));
    }

    public function create()
    {
        //
    }

    public function store(StoreOrganizationRequest $request): void
    {
        Organization::create($request->validated());
    }

    public function show(Request $request, Organization $organization): array
    {
        return OrganizationResource::make($organization)->toArray($request);
    }

    public function edit(Organization $organization)
    {
        //
    }

    public function update(UpdateOrganizationRequest $request, Organization $organization): void
    {
        $organization->update($request->validated());
    }

    public function destroy(Organization $organization): void
    {
        $organization->delete();
    }
}
