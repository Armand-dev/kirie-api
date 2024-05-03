<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models\Landlord{
/**
 * App\Models\Landlord\Lease
 *
 * @property int $id
 * @property string $number
 * @property string $body
 * @property \App\Enums\Landlord\SignatureType|null $signature_type
 * @property \App\Enums\Landlord\LeaseStatus|null $status
 * @property string|null $start_date
 * @property string|null $end_date
 * @property int|null $duration
 * @property string|null $rent_amount
 * @property int $additional_people
 * @property string|null $deposit
 * @property int|null $due_day
 * @property int $user_id
 * @property int $property_id
 * @property int|null $tenant_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $file_url
 * @property-read \App\Models\Landlord\Property|null $property
 * @property-read \App\Models\User|null $tenant
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Landlord\Transaction> $transactions
 * @property-read int|null $transactions_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Lease active()
 * @method static \Illuminate\Database\Eloquent\Builder|Lease newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lease newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lease onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Lease query()
 * @method static \Illuminate\Database\Eloquent\Builder|Lease whereAdditionalPeople($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lease whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lease whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lease whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lease whereDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lease whereDueDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lease whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lease whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lease whereFileUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lease whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lease whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lease wherePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lease whereRentAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lease whereSignatureType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lease whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lease whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lease whereTenantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lease whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lease whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lease withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Lease withoutTrashed()
 */
	class Lease extends \Eloquent {}
}

namespace App\Models\Landlord{
/**
 * App\Models\Landlord\LeaseTemplate
 *
 * @property int $id
 * @property string $name
 * @property string $body
 * @property \App\Enums\Landlord\LeaseTemplateGlobal $global
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|LeaseTemplate global()
 * @method static \Illuminate\Database\Eloquent\Builder|LeaseTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LeaseTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LeaseTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LeaseTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|LeaseTemplate whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LeaseTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LeaseTemplate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LeaseTemplate whereGlobal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LeaseTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LeaseTemplate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LeaseTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LeaseTemplate whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LeaseTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LeaseTemplate withoutTrashed()
 */
	class LeaseTemplate extends \Eloquent {}
}

namespace App\Models\Landlord{
/**
 * App\Models\Landlord\Property
 *
 * @property int $id
 * @property string $name
 * @property \App\Enums\Landlord\PropertyType $type
 * @property string|null $cost_of_acquisition
 * @property int|null $rooms
 * @property int|null $baths
 * @property string|null $area
 * @property int|null $parking
 * @property string|null $street
 * @property string|null $street_number
 * @property string|null $address
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Landlord\Lease> $activeLease
 * @property-read int|null $active_lease_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Landlord\Lease> $leases
 * @property-read int|null $leases_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Property newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Property newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Property onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Property query()
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereBaths($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereCostOfAcquisition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereParking($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereRooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereStreetNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Property withoutTrashed()
 */
	class Property extends \Eloquent {}
}

namespace App\Models\Landlord{
/**
 * App\Models\Landlord\Tenant
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $landlords
 * @property-read int|null $landlords_count
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereUpdatedAt($value)
 */
	class Tenant extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Landlord\Transaction
 *
 * @property int $id
 * @property \App\Enums\Landlord\TransactionType $type
 * @property \Illuminate\Support\Carbon $date
 * @property string $description
 * @property string $total
 * @property int $user_id
 * @property int|null $lease_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \App\Enums\Landlord\TransactionStatus $status
 * @property-read \App\Models\Landlord\Lease|null $lease
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Landlord\Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Landlord\Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Landlord\Transaction onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Landlord\Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Landlord\Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Landlord\Transaction whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Landlord\Transaction whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Landlord\Transaction whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Landlord\Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Landlord\Transaction whereLeaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Landlord\Transaction whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Landlord\Transaction whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Landlord\Transaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Landlord\Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Landlord\Transaction whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Landlord\Transaction withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Landlord\Transaction withoutTrashed()
 */
	class Transaction extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Landlord\LeaseTemplate> $leaseTemplates
 * @property-read int|null $lease_templates_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Landlord\Lease> $leases
 * @property-read int|null $leases_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Landlord\Property> $properties
 * @property-read int|null $properties_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Landlord\Tenant> $tenants
 * @property-read int|null $tenants_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Landlord\Transaction> $transactions
 * @property-read int|null $transactions_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutTrashed()
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

