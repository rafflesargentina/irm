<?php

namespace Raffles\Modules\Lrm\Models;

use Raffles\Models\User as Model;

class User extends Model
{
    /**
     * Get the user's contact.
     */
    public function contact()
    {
        return $this->morphOne(Contact::class, 'contactable');
    }

    /**
     * Get the user's contacts.
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
