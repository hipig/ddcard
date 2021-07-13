<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserSubscriptionRecord;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserSubscriptionRecordPolicy
{
    use HandlesAuthorization;

    public function own(User $user, UserSubscriptionRecord $record)
    {
        return $record->user_id == $user->id;
    }
}
