<?php

namespace App\FilamentShield\Resources\Roles;

use BezhanSalleh\FilamentShield\Resources\Roles\RoleResource as RoleBaseResource;

class RoleResource extends RoleBaseResource
{
    protected static ?string $tenantOwnershipRelationshipName = 'churches';
}
