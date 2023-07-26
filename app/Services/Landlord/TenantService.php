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
    public function store(TenantDTO $tenantDTO)
    {
        $tenant = Tenant::create([
            'first_name' => $tenantDTO->first_name,
            'last_name' => $tenantDTO->last_name,
            'email' => $tenantDTO->email,
            'password' => Hash::make(Str::random())
        ]);

        $tenant = User::find($tenant->id);
        $tenant->assignRole('tenant');

        auth()->user()->tenants()->attach($tenant->id);

        return $tenant;
    }

    public function update(Tenant $tenant, TenantDTO $tenantDTO)
    {
        return tap($tenant)->update([
            'first_name' => $tenantDTO->first_name,
            'last_name' => $tenantDTO->last_name
        ]);

    }
}
