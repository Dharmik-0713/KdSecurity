<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $clients = Client::with('auditTargets')->get();
        $totalClients = $clients->count();
        $inProgressAudits = $clients->where('status', 'active')->count();
        $completedProjects = $clients->where('status', 'completed')->count();
        $pendingReports = $clients->filter(function($c) {
            return $c->overall_progress < 100;
        })->count();

        return view('admin.admin', compact('clients', 'totalClients', 'inProgressAudits', 'completedProjects', 'pendingReports'));
    }

    public function clientDetail($id = null)
    {
        // Default to TechCorp Inc. if no ID provided
        $client = $id ? Client::with('auditTargets')->findOrFail($id) : Client::with('auditTargets')->first();
        return view('admin.client-detail', compact('client'));
    }

    public function contactRequests()
    {
        $requests = \App\Models\ContactRequest::latest()->get();
        $total = $requests->count();
        $pending = $requests->where('status', 'pending')->count();
        $reviewed = $requests->where('status', 'reviewed')->count();
        $scheduled = $requests->where('status', 'scheduled')->count();
        return view('admin.contact-requests', compact('requests', 'total', 'pending', 'reviewed', 'scheduled'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,reviewed,scheduled',
            'scheduled_date' => 'nullable|date'
        ]);

        $contact = \App\Models\ContactRequest::findOrFail($id);
        $contact->status = $request->status;
        if ($request->status === 'scheduled' && $request->has('scheduled_date')) {
            $contact->scheduled_date = $request->scheduled_date;
        } else {
            $contact->scheduled_date = null;
        }
        $contact->save();

        // Sync client visibility on the Admin Control Panel (client page)
        // - reviewed  → client appears on the client page
        // - pending  → client hidden from the client page
        // - scheduled → client hidden from the client page
        $existingClient = \App\Models\Client::where('name', $contact->full_name)->first();

        if ($contact->status === 'reviewed') {
            $clientData = [
                'domain' => $contact->website_url ?? 'N/A',
                'status' => 'active',
                'package' => 'Standard Audit',
                'total_contract_value' => 0,
                'payment_received' => 0,
                'overall_progress' => 0,
            ];

            if ($existingClient) {
                $existingClient->update($clientData);
            } else {
                \App\Models\Client::create(array_merge(['name' => $contact->full_name], $clientData));
            }
        } else {
            // pending or scheduled → remove from client page
            if ($existingClient) {
                $existingClient->delete();
            }
        }

        // Send email notification when scheduled
        if ($contact->status === 'scheduled') {
            try {
                \Illuminate\Support\Facades\Mail::raw("Your audit is scheduled!\n\nName: {$contact->full_name}\nDate: {$contact->scheduled_date}\nWebsite: {$contact->website_url}", function ($message) {
                    $message->to($contact->email)
                            ->cc('dharmik.poshia@gmail.com')
                            ->subject('Audit Scheduled - KdSecurity');
                });
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Mail error: ' . $e->getMessage());
            }
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Status updated successfully!']);
        }

        return back()->with('success', 'Status updated successfully!');
    }
}