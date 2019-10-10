<?php

namespace App\Http\Controllers;

use App\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    //Get all visitor
    public function visitor()
    {
        $res = Visitor::get();
        return response()->json($res, 200);
    }


    //Get single visitor
    public function visitorById($id)
    {

        $res = Visitor::find($id);
        if (is_null($res)) {
            return response()->json('Record not found!', 404);
        }
        return response()->json($res, 200);
    }
}
