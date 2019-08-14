<?php

namespace Raffles\Modules\Lrm\Http\Controllers\Contacts;

use Raffles\Http\Controllers\Controller;
use Raffles\Modules\Lrm\Imports\ContactsImport;

use Illuminate\Http\Request;

class ImportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        Excel::import(new ContactsImport, $request->file('file'));
    }
}
