<?php

namespace Raffles\Modules\Lrm\Models;

use Raffles\Models\{ Address, Company };
use Raffles\Models\Contact as Model;

class Contact extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comment',
        'company_id',
        'contactable_id',
        'contactable_type',
        'email',
        'first_name',
        'last_name',
        'fax',
        'mobile',
        'phone',
        'position',
        'source',
        'user_id',
        'website',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['address', 'company', 'featured_photo'];

    /**
     * Get the contact's address.
     */
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    /**
     * Get the company that owns the contact.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * The subscription lists that belong to the contact.
     */
    public function subscription_lists()
    {
        return $this->belongsToMany(SubscriptionList::class);
    }
}
