<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;
use App\Http\Resources\OrganizationResource;
use App\Models\Organization;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;

class OrganizationController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return OrganizationResource::collection(Organization::paginate(100));
    }

    public function create()
    {
        //
    }

    public function store(StoreOrganizationRequest $request): OrganizationResource
    {
        $organization = Organization::create($request->validated());

        return OrganizationResource::make($organization);
    }

    public function show(Organization $organization): OrganizationResource
    {
        return OrganizationResource::make($organization);
    }

    public function edit(Organization $organization)
    {
        //
    }

    public function update(UpdateOrganizationRequest $request, Organization $organization): HttpResponse
    {
        $organization->update($request->validated());

        return Response::noContent();
    }

    public function destroy(Organization $organization): HttpResponse
    {
        $organization->delete();

        return Response::noContent();
    }

    public function list()
    {
        //
    }
}
