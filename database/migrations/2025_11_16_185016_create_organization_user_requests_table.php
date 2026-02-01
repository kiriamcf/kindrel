<?php

use App\Enums\OrgRequestStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organization_user_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('organization_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('status')->default(OrgRequestStatus::PENDING->value);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organization_user_requests');
    }
};
