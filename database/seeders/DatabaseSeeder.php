<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\OrgRequestStatus;
use App\Enums\OrgRole;
use App\Models\Organization;
use App\Models\OrganizationUserRequest;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $organization = Organization::create([
            'name' => 'Protectors de Gats', 
            'description' => 'Una organització dedicada a la protecció i el benestar dels gats.',
            'slug' => 'protectors-de-gats',
            'email' => 'info@protectorsdegats.org',
        ]);

        OrganizationUserRequest::create([
            'organization_id' => $organization->id,
            'user_id' => $user->id,
            'status' => OrgRequestStatus::APPROVED->value,
        ]);

        $organization->users()->attach($user->id, [
            'role' => OrgRole::OWNER->value,
        ]);

        $this->call([
            SpeciesSeeder::class,
            BreedSeeder::class,
        ]);
    }
}
