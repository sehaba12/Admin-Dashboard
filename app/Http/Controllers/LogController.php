<?php

// app/Http/Controllers/LogController.php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Models\Logs;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    public function index(): JsonResponse
    {
        // if(Auth::user()){
        // if (Auth::user()->can('view requests')){
            $logs = Logs::all();
            return response()->json($logs);
        // }else {
        //     return response()->json(['message' => 'Unauthorized'], 403);
        // }

        // return Logs::latest()->pagination(10);

    }
}
