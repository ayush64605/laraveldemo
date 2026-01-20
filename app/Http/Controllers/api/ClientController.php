<?php

namespace App\Http\Controllers\api;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class ClientController extends Controller
{
    public function show(Request $request)
    {
        $clients = DB::table('clients')
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('company', 'LIKE', "%{$search}%")
                        ->orWhere('phonenumber', 'LIKE', "%{$search}%");
                });
            })
            ->when($request->state, function ($query, $state) {
                return $query->where('state', $state);
            })
            ->when($request->city, function ($query, $city) {
                return $query->where('city', $city);
            })
            ->paginate(15);

        return response()->json($clients);
    }


    public function delete($client)
    {
        try {
            DB::table('clients')->where('userid', $client)->delete();
            return response()->json(["message" => "Client Deleted Successfully"], 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "Error in deleting client"], 500);
        }
    }
}