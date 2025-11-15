<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Frequency;
use Illuminate\Auth\Access\HandlesAuthorization;

class FrequencyPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Frequency');
    }

    public function view(AuthUser $authUser, Frequency $frequency): bool
    {
        return $authUser->can('View:Frequency');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Frequency');
    }

    public function update(AuthUser $authUser, Frequency $frequency): bool
    {
        return $authUser->can('Update:Frequency');
    }

    public function delete(AuthUser $authUser, Frequency $frequency): bool
    {
        return $authUser->can('Delete:Frequency');
    }

    public function restore(AuthUser $authUser, Frequency $frequency): bool
    {
        return $authUser->can('Restore:Frequency');
    }

    public function forceDelete(AuthUser $authUser, Frequency $frequency): bool
    {
        return $authUser->can('ForceDelete:Frequency');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Frequency');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Frequency');
    }

    public function replicate(AuthUser $authUser, Frequency $frequency): bool
    {
        return $authUser->can('Replicate:Frequency');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Frequency');
    }

}