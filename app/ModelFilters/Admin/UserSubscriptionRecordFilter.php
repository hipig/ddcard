<?php

namespace App\ModelFilters\Admin;

use EloquentFilter\ModelFilter;

class UserSubscriptionRecordFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function user($user)
    {
        return $this->where('user_id', $user);
    }

    public function plan($plan)
    {
        return $this->where('plan_id', $plan);
    }
}
