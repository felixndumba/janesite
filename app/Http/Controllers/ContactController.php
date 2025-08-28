<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
     public function send(Request $request)
    {
        // Validate mandatory fields
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Send email
        Mail::to('bundif2003@gmail.com')->send(new ContactMail($validated));

        return back()->with('success', 'Your message has been sent successfully!');
    }
}
