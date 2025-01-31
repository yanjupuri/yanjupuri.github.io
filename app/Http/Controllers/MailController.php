<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Mail\UserReceiptMail;
use Swift_TransportException;

class MailController extends Controller
{
    public function sendMail(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
            'subject' => 'required|string'
        ]);

        try {
            // Support Team email support@quickiefixtech.online
            Mail::to('quickiefixtech@gmail.com')->send(new ContactFormMail($request->all())); // Mail to QuickieTech Creations Support Team
            
            Mail::to($request->email)->send(new UserReceiptMail($request->all())); // User Receipt

            return redirect()->back()->with('success', 'Your message has been sent successfully!');
        } catch (Swift_TransportException $e) {
            return back()->withInput()->withErrors(['error' => 'Error: Please check your internet connection or try again later.']);
        }
    }
}
