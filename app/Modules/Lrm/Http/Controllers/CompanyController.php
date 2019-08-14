<?php

namespace Raffles\Modules\Lrm\Http\Controllers;

use Raffles\Repositories\CompanyRepository;

use Illuminate\Http\Request;
use RafflesArgentina\ResourceController\ApiResourceController;

class CompanyController extends ApiResourceController
{
    protected $repository = CompanyRepository::class;

    protected $resourceName = 'companies';
}
