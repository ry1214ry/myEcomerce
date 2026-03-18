<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        // Here you would send an email notification
        // Mail::to('admin@luxeshop.com')->send(new ContactMail($request->all()));

        return back()->with('success', 'Your message has been sent. We will get back to you shortly!');
    }
}