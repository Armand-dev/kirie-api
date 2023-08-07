<?php

namespace App\Services\Landlord;

use App\DataTransferObjects\Landlord\PropertyDTO;
use App\DataTransferObjects\Landlord\TenantDTO;
use App\Models\Landlord\Lease;
use App\Models\Landlord\Property;
use App\Models\Landlord\Tenant;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TenantService
{
    /**
     * @param TenantDTO $tenantDTO
     * @param User $user
     * @return Tenant
     */
    public function store(TenantDTO $tenantDTO, User $user): User
    {
        $tenant = Tenant::create([
            'first_name' => $tenantDTO->first_name,
            'last_name' => $tenantDTO->last_name,
            'email' => $tenantDTO->email,
            'password' => Hash::make(Str::random())
        ]);

        /** @var User $tenantUser */
        $tenantUser = User::find($tenant->id);
        $tenantUser->assignRole('tenant');

        $user->tenants()->attach($tenantUser->id);

        return $tenantUser;
    }

    /**
     * @param Tenant $tenant
     * @param TenantDTO $tenantDTO
     * @return Tenant
     */
    public function update(Tenant $tenant, TenantDTO $tenantDTO): User
    {
        $tenant->update([
            'first_name' => $tenantDTO->first_name,
            'last_name' => $tenantDTO->last_name
        ]);

        return User::find($tenant->id);
    }
}
