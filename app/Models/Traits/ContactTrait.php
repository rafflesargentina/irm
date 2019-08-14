<?php

namespace Raffles\Models\Traits;

trait ContactTrait {
    /**
     * Get the contact's name.
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->attributes['name'] = $this->first_name.' '.$this->last_name;
    }
}
