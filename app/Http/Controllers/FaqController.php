<?php

namespace App\Http\Controllers;

use App\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class FaqController extends Controller
{

    public function validateRequest(Request $request)
    {
        $rules = [
            'title' => 'required|string',
            'content' => 'required|string',
        ];
        $this->validate($request, $rules);
    }


    public function index()
    {
        $faqs = Faq::all();
        if ($faqs) {
            $res['status']  = true;
            $res['message'] = 'All Frequently asked questions';
            $res['faqs'] = $faqs;
            return response()->json($res, 200);
        } else {
            $res['status']  = false;
            $res['message'] = 'No Record found';
            return response()->json($res, 404);
        }
    }


    public function store(Request $request)
    {
        $this->validateRequest($request);
        DB::beginTransaction();
        $title = $request->input('title');
        $content        = $request->input('content');
        $faq = Faq::create([
            'title'    => $title,
            'content'           => $content,
        ]);
        $msg['status']  = true;
        $msg['status_code'] = 201;
        $msg['message'] = 'Faq created successfully!';
        $msg['faq'] = $faq;
        DB::commit();
        return response()->json($msg, $msg['status_code']);
    }



    public function update(Request $request, Faq $faq, $id)
    {
        $this->validateRequest($request);
        DB::beginTransaction();


        $faq = Faq::where('id', $id)->first();
        if ($faq) {
            $faq->title  = $request->input('title');
            $faq->content         = $request->input('content');
            $faq->save();

            $msg['status_code'] = 201;
            $msg['message'] = 'Faq updated succesfully!';
            $msg['faq'] = $faq;
        } else {
            $msg['status_code'] = 404;
            $msg['message'] = 'Faq not found!';
        }
        DB::commit();
        return response()->json($msg, $msg['status_code']);
    }

    public function show($id)
    {

        $faq = Faq::where('id', $id)->first();
        if (!$faq) {
            $res['status']  = false;
            $res['message'] = 'No Faq found';
            return response()->json($res, 404);
        } else {
            $res['status']  = true;
            $res['message'] = 'Data Found (By Name)';
            $res['faq']  = $faq;
            return response()->json($res, 200);
        }
    }




    public function destroy($id)
    {

        $faq = Faq::where('id', $id)->first();
        $faq->delete();
        // Success message
        $res['message']    = "Faq deleted";
        return response()->json($res, 200);
    }
}
