<?php

namespace App\Http\Controllers;

use App\Mail\SupportMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Support;

class SupportController extends Controller
{
    public function index()
    {
        $support = Support::all();
        return response()->json(['data' => $support]);
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'email' =>  ['required', 'email'],
            'subject'  =>  ['required', 'string', 'min:4'],
            'message' => ['required', 'string', 'min:10'],
        ]);

        DB::beginTransaction();

        try {
            Support::create($data);

            Mail::to(config('mail.support_address'))->send(new SupportMail($data));

            DB::commit();

            return response()->json(['message' => 'Your message has been sent and we will get back to you soon.']);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error was encountered, please retry later.',
                'hint' =>  $e->getMessage(),
            ], 501);
        }


    }

    public function show($id)
    {
        $support = Support::where('id', $id)->firstOrFail();

        return response()->json(['message' => 'Support message retrieved.', 'data' => $support]);
    }


    public function destroy($id)
    {
        $support = Support::where('id', $id)->firstOrfail();
        $support->delete();

        return response()->json(null, 204);
    }
}
