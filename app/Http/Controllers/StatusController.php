<?php

namespace App\Http\Controllers;

use App\Status;
use Faker\Generator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    protected $status;
    public function __construct(Status $status)
    {
        $this->status = $status;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // TODO : faire fonctionner avec le auth::id
        return response($this->status->all()->jsonSerialize(), Response::HTTP_OK);
    }

}
