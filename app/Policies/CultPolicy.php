<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Cult;
use Illuminate\Auth\Access\HandlesAuthorization;

class CultPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Cult');
    }

    public function view(AuthUser $authUser, Cult $cult): bool
    {
        return $authUser->can('View:Cult');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Cult');
    }

    public function update(AuthUser $authUser, Cult $cult): bool
    {
        return $authUser->can('Update:Cult');
    }

    public function delete(AuthUser $authUser, Cult $cult): bool
    {
        return $authUser->can('Delete:Cult');
    }

    public function restore(AuthUser $authUser, Cult $cult): bool
    {
        return $authUser->can('Restore:Cult');
    }

    public function forceDelete(AuthUser $authUser, Cult $cult): bool
    {
        return $authUser->can('ForceDelete:Cult');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Cult');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Cult');
    }

    public function replicate(AuthUser $authUser, Cult $cult): bool
    {
        return $authUser->can('Replicate:Cult');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Cult');
    }

}