<?php

namespace App\Http\Controllers\Api;

use App\Contracts\PhoneNumberServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\PhoneNumber as PhoneNumberResource;
use Illuminate\Http\Request;

class PhoneNumberController extends Controller
{
    /**
     * @var object
     */
    protected $service;

    /**
     * Init new object.
     *
     * @param   RepositoryInterface $service
     * @return  void
     */
    public function __construct(PhoneNumberServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Fetch all records from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return PhoneNumberResource::collection($this->service->paginateBy($request->query(), $request->query('perPage'), [], $request->query('sortBy'), $request->query('desc')));
    }
}
