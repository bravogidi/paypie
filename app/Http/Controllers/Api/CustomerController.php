<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Customer::all();

        return Response::json([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * Display a single resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = Customer::find($request->id);

        if (!$data) {
            return Response::json([
                'success' => false,
                'message' => 'Not found '
            ], 400);
        }

        return Response::json([
            'success' => true,
            'data' => $data
        ]);
    }
}
