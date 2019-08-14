<?php

namespace Raffles\Modules\Lrm\Http\Controllers;

use Raffles\Modules\Lrm\Repositories\SubscriptionListRepository;

use Illuminate\Http\Request;
use RafflesArgentina\ResourceController\ApiResourceController;

class SubscriptionListController extends ApiResourceController
{
    protected $repository = SubscriptionListRepository::class;

    protected $resourceName = 'subscription-lists';
}
