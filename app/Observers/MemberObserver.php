<?php

namespace App\Observers;

use App\Constants\FeatureKey;
use App\Models\Member;
use Illuminate\Support\Facades\Cache;

class MemberObserver
{
    /**
     * Handle the Member "created" event.
     */
    public function created(Member $member): void
    {
        $this->clearMemberCache($member);
    }

    /**
     * Handle the Member "updated" event.
     */
    public function updated(Member $member): void
    {
        $this->clearMemberCache($member);
    }

    /**
     * Handle the Member "deleted" event.
     */
    public function deleted(Member $member): void
    {
        $this->clearMemberCache($member);
    }

    /**
     * Handle the Member "restored" event.
     */
    public function restored(Member $member): void
    {
        $this->clearMemberCache($member);
    }

    /**
     * Handle the Member "force deleted" event.
     */
    public function forceDeleted(Member $member): void
    {
        //
    }

    private function clearMemberCache(Member $member): void
    {
        $cacheKey = "church_{$member->team_id}_count_" . FeatureKey::MEMBER_LIMIT;

        Cache::forget($cacheKey);
    }
}
