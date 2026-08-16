<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'mobile' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:200',
            'message' => 'required|string|max:5000',
            'cf-turnstile-response' => 'required',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Cloudflare Turnstile Verification
        |--------------------------------------------------------------------------
        */

        $turnstileResponse = Http::asForm()->post(
            'https://challenges.cloudflare.com/turnstile/v0/siteverify',
            [
                'secret' => env('TURNSTILE_SECRET_KEY'),
                'response' => $request->input('cf-turnstile-response'),
                'remoteip' => $request->ip(),
            ]
        );


        if (
            !$turnstileResponse->successful() ||
            !$turnstileResponse->json('success')
        ) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Captcha verification failed. Please try again.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Save Contact Message
        |--------------------------------------------------------------------------
        */

        Contact::create([
            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'mobile' => $request->post('mobile'),
            'subject' => $request->post('subject'),
            'message' => $request->post('message'),
            'ip_address' => $request->ip(),
            'is_read' => 0,
        ]);


        /*
        |--------------------------------------------------------------------------
        | Success
        |--------------------------------------------------------------------------
        */

        return back()->with(
            'success',
            'Thank you! Your message has been sent successfully.'
        );
    }
}
