<?php

namespace Raffles\Modules\Lrm\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionList extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'name',
        'slug'
    ];
}
