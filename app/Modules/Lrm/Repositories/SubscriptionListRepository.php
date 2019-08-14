<?php

namespace Raffles\Modules\Lrm\Repositories;

use Raffles\Modules\Lrm\Models\SubscriptionList;

use Caffeinated\Repository\Repositories\EloquentRepository;

class SubscriptionListRepository extends EloquentRepository
{
    /**
     * @var Model
     */
    public $model = SubscriptionList::class;

    /**
     * @var array
     */
    public $tag = ['SubscriptionList'];
}
