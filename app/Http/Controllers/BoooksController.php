<?php

namespace App\Http\Controllers;

use App\Rules\isbn;
use App\Services\NytApiClient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BoooksController extends Controller
{
    public function __construct(private NytApiClient $apiCLient)
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->validate([
            'author' => 'string',
            'isbn' => 'array',
            'isbn.*' => ['string', new isbn()],
            'title' => 'string',
            'offset' => 'integer|multiple_of:20',
        ]);
        return $this->apiCLient->bestSellers($params);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

}
