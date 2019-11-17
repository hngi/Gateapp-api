<?php

namespace App\Http\Controllers;

use App\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class FaqController extends Controller
{

    public function index()
    {
        $faqs = Faq::all();

        return response()->json([
           'status' => true,
           'count' => $faqs->count(),
           'data' => $faqs,
        ]);
    }


    public function store(Request $request)
    {
       $request->validate([
           'title' => ['required', 'string', 'min:4', 'unique:faqs'],
           'content' => ['required', 'string', 'min:10']
       ]);

        $title = $request->input('title');
        $content  = $request->input('content');

        $faq = Faq::create([
            'title'  => $title,
            'content'  => $content,
        ]);
        $msg['status']  = true;
        $msg['message'] = 'FAQ item added successfully!';
        $msg['data'] = $faq;

        return response()->json($msg, 201);
    }



    public function update(Request $request, $id)
    {
        $request->validate([
           'title' =>  ['required', 'string', Rule::unique('faqs')->ignore($id)] ,
            'content' => ['required', 'string', 'min:10'],
        ]);

        $faq = Faq::query()->findOrFail($id);

        $faq->title  = $request->input('title');
        $faq->content  = $request->input('content');
        $faq->update();

        $msg['message'] = 'FAQ item updated successfully!';
        $msg['data'] = $faq;

        return response()->json($msg);
    }

    public function show($id)
    {
        $faq = Faq::query()->where('id', $id)->firstOrFail();

        $res['status']  = true;
        $res['data']  = $faq;

        return response()->json($res);
    }


    public function destroy($id)
    {
        $faq = Faq::where('id', $id)->firstOrFail();
        $faq->delete();

        return response(null, 204);
    }
}
