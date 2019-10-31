<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewsletterSubscriber;
use Newsletter;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:4',
            'email' => 'required|email',
        ]);



       if ( ! Newsletter::isSubscribed($validatedData['email']) ) {
            Newsletter::subscribe($validatedData['email']);
        }


        NewsletterSubscriber::create($validatedData);

        return response()->json([
            'message' => "Thank you for subscribing."
        ]);

    }
}
