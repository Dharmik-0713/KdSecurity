<?php

namespace App\Http\Controllers\Frontend;

use App\Models\ContactRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'website_url' => 'nullable|url|max:255',
            'message' => 'nullable|string|max:5000',
        ]);

        ContactRequest::create($data);

        // Send email notification to Admin
        try {
            Mail::raw("New Contact Request Details:\n\nName: {$data['full_name']}\nEmail: {$data['email']}\nPhone: {$data['phone']}\nWebsite: {$data['website_url']}\nMessage: {$data['message']}", function ($message) {
                $message->to('dharmik.poshia@gmail.com')
                        ->subject('New Security Audit Request - KdSecurity');
            });
        } catch (\Exception $e) {
            Log::error("Failed to send contact email: " . $e->getMessage());
        }

        return redirect()->route('contact')
            ->with('success', 'Thank you, ' . $data['full_name'] . '. Your security audit request has been received. We will contact you shortly.');
    }
}