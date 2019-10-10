<?php

namespace App\Http\Controllers;
use App\Estate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EstateController extends Controller
{
    public function index() {
        $estate = Estate::estate(); 
        
        return response()->json($estate);
    }
    public function all() {
        $estate = Estate::all();
        return response()->json($estate);
    }

    public function show($id) {
        $estate = Estate::find($id);
        return response()->json($estate);
    }

    public function destroy() {
        $estate = Estate::estates();
        $estate->delete();

        $reponse = array('response' => 'Item deleted successfully', 'success' => true);
        return $response;
    }
}
