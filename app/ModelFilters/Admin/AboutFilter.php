<?php

namespace App\ModelFilters\Admin;

use EloquentFilter\ModelFilter;

class AboutFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function name($name)
    {
        return $this->where('zh_name', 'like', "%$name%");
    }

    public function key($key)
    {
        return $this->where('key', $key);
    }
}
