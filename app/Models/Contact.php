<?php

namespace Raffles\Models;

use Raffles\Models\Traits\ContactTrait;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use ContactTrait;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'name'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
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
     * Get the contact's addresses.
     */
    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    /**
     * Get the company that owns the contact.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get all of the owning contactable models.
     */
    public function contactable()
    {
        return $this->morphTo();
    }

    /**
     * Get the contact's featured address.
     */
    public function featured_address()
    {
        return $this->morphOne(FeaturedAddress::class, 'addressable');
    }

    /**
     * Get the contact's featured photo.
     */
    public function featured_photo()
    {
        return $this->morphOne(FeaturedPhoto::class, 'photoable')->withDefault();
    }

    /**
     * Get the contact's map.
     */
    public function map()
    {
        return $this->morphOne(Map::class, 'mapable')->withDefault();
    }

    /**
     * Get the contact's unfeatured address.
     */
    public function unfeatured_address()
    {
        return $this->morphOne(UnfeaturedAddress::class, 'addressable');
    }

    /**
     * Get all of the contact's unfeatured photos.
     */
    public function unfeatured_photos()
    {
        return $this->morphMany(UnfeaturedPhoto::class, 'photoable');
    }

    /**
     * Get the user that owns the contact.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
