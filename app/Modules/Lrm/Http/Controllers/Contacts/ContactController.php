<?php

namespace Raffles\Modules\Lrm\Http\Controllers\Contacts;

use Raffles\Modules\Lrm\Repositories\ContactRepository;

use Illuminate\Http\Request;
use RafflesArgentina\ResourceController\ApiResourceController;

class ContactController extends ApiResourceController
{
    protected $repository = ContactRepository::class;

    protected $resourceName = 'contacts';

    /**
     * Display the specified resource.
     *
     * @param Request $request The request object.
     * @param string  $key     The model key.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $key)
    {
        $model = $this->findFirstByKey($key);

        if (!$model) {
            return $this->validNotFoundJsonResponse();
        }

        $model->load('subscription_lists');

        return response()->json($model, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Get items collection.
     *
     * @param string $orderBy The order key.
     * @param string $order   The order direction.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getItemsCollection($orderBy = 'updated_at', $order = 'desc')
    {
        $newQuery = $this->repository->newQuery();

        if (request()->country) {
            $newQuery->whereHas('address', function($q) { $q->where('country', request()->country); });
        }


        if (request()->list) {
            $this->repository->load('subscription_lists');
            $newQuery->whereHas('subscription_lists', function($q) { $q->where('subscription_lists.id', request()->list); });
        }

        return $newQuery->get();
    }
}
