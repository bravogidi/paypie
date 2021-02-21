<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Transaction::all();

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
        $data = Transaction::find($request->id);

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
