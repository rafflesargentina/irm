<?php

namespace Raffles\Modules\Lrm\Http\Controllers;

use Raffles\Http\Controllers\Controller;
use Raffles\Repositories\AddressRepository;

use Illuminate\Http\Request;
use RafflesArgentina\ResourceController\Traits\FormatsValidJsonResponses;

class CountryController extends Controller
{
    use FormatsValidJsonResponses;

    /**
     * Create a new CountryController instance.
     *
     * @param AddressRepository $repository
     *
     * @return void
     */
    public function __construct(AddressRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $items = $this->repository->groupBy('country')->get(['country'])->pluck('country');

        return $this->validSuccessJsonResponse('Success', $items);
    }
}
