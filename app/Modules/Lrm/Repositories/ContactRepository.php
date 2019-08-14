<?php

namespace Raffles\Modules\Lrm\Repositories;

use Raffles\Modules\Lrm\Models\Contact;
use Raffles\Repositories\ContactRepository as EloquentRepository;

class ContactRepository extends EloquentRepository
{
    /**
     * @var Model
     */
    public $model = Contact::class;

    /**
     * @var array
     */
    public $tag = ['Contact'];
}
