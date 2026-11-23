<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Requests | KdSecurity Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class', theme: { extend: { colors: { cyber: { blue: '#00f2ff', dark: '#0a0a0a', sidebar: '#111111' } } } } }
    </script>
</head>
<body class="bg-cyber-dark text-white font-sans flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-cyber-sidebar border-r border-cyber-blue/10 p-6 flex flex-col justify-between">
        <div>
            <div class="text-2xl font-bold mb-10 text-white">Kd<span class="text-cyber-blue">Security</span> <span class="text-xs bg-red-600 text-white px-2 py-0.5 rounded uppercase">Admin</span></div>
            <nav class="space-y-4">
                <a href="/admin" class="block p-3 text-gray-400 hover:text-white transition">Client Management</a>
                <a href="/admin/contact-requests" class="block p-3 bg-cyber-blue/10 text-cyber-blue rounded-lg border-l-2 border-cyber-blue">Contact Requests</a>
                <a href="/dashboard" class="block p-3 text-gray-400 hover:text-white transition">Dashboard</a>
                <a href="/services" class="block p-3 text-gray-400 hover:text-white transition">Services</a>
            </nav>
        </div>
        <div class="text-xs text-gray-500">
            Logged in as <span class="text-cyber-blue">{{ session('user.name') }}</span>
        </div>
        <a href="/logout" class="text-xs text-red-400 hover:text-red-300 mt-2">Logout</a>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-10 overflow-y-auto">
        <header class="mb-10 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold">Contact Requests</h1>
                <p class="text-gray-400 text-sm mt-1">Security audit inquiries submitted through the website</p>
            </div>
        </header>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
            <div class="bg-cyber-sidebar p-5 rounded-xl border border-gray-800">
                <p class="text-gray-400 text-xs uppercase tracking-wider">Total Requests</p>
                <p class="text-3xl font-bold mt-2">{{ $total }}</p>
            </div>
            <div class="bg-cyber-sidebar p-5 rounded-xl border border-gray-800">
                <p class="text-gray-400 text-xs uppercase tracking-wider">Pending Review</p>
                <p class="text-3xl font-bold mt-2 text-yellow-500">{{ $pending }}</p>
            </div>
            <div class="bg-cyber-sidebar p-5 rounded-xl border border-gray-800">
                <p class="text-gray-400 text-xs uppercase tracking-wider">Reviewed</p>
                <p class="text-3xl font-bold mt-2 text-blue-400">{{ $reviewed }}</p>
            </div>
            <div class="bg-cyber-sidebar p-5 rounded-xl border border-gray-800">
                <p class="text-gray-400 text-xs uppercase tracking-wider">Scheduled</p>
                <p class="text-3xl font-bold mt-2 text-green-400">{{ $scheduled }}</p>
            </div>
        </div>

        <!-- Requests Table -->
        <div class="bg-cyber-sidebar rounded-xl border border-gray-800 p-6">
            <h2 class="text-xl font-bold mb-6">Inbound Audit Requests</h2>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-800 text-gray-400 text-xs uppercase tracking-wider">
                            <th class="pb-4">ID</th>
                            <th class="pb-4">Full Name</th>
                            <th class="pb-4">Email</th>
                            <th class="pb-4">Phone</th>
                            <th class="pb-4">Website URL</th>
                            <th class="pb-4">Message</th>
                            <th class="pb-4">Status</th>
                            <th class="pb-4">Submitted</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800 text-sm">
                        @forelse($requests as $request)
                            <tr>
                                <td class="py-4 text-gray-500">#{{ $request->id }}</td>
                                <td class="py-4 font-semibold">{{ $request->full_name }}</td>
                                <td class="py-4 text-cyber-blue">{{ $request->email }}</td>
                                <td class="py-4 text-gray-400">{{ $request->phone ?? '—' }}</td>
                                <td class="py-4 text-gray-400">{{ $request->website_url ?? '—' }}</td>
                                <td class="py-4 text-gray-400 max-w-sm truncate" title="{{ $request->message ?? '—' }}">{{ $request->message ?? '—' }}</td>
                                <td class="py-4">
                                    <div class="flex flex-col gap-2">
                                        <select id="status-{{ $request->id }}" onchange="updateStatus({{ $request->id }})" class="bg-black text-xs p-1.5 rounded border border-gray-700 text-white w-full">
                                            <option value="pending" {{ $request->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="reviewed" {{ $request->status === 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                                            <option value="scheduled" {{ $request->status === 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                                        </select>

                                        <div id="date-container-{{ $request->id }}" class="{{ $request->status === 'scheduled' ? '' : 'hidden' }}">
                                            <input type="date" id="date-{{ $request->id }}" value="{{ $request->scheduled_date }}" onchange="updateStatus({{ $request->id }})" class="bg-black text-xs p-1 rounded border border-gray-700 text-white w-full mb-1">
                                        </div>

                                        <span id="msg-{{ $request->id }}" class="text-[10px] text-cyber-blue"></span>
                                    </div>
                                </td>
                                <td class="py-4 text-gray-500">{{ $request->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-8 text-center text-gray-500">No contact requests found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        function updateStatus(id) {
            const status = document.getElementById('status-' + id).value;
            const dateInput = document.getElementById('date-' + id);
            const dateContainer = document.getElementById('date-container-' + id);
            const msgSpan = document.getElementById('msg-' + id);

            // Show/hide date picker if scheduled
            if (status === 'scheduled') {
                dateContainer.classList.remove('hidden');
            } else {
                dateContainer.classList.add('hidden');
            }

            const scheduledDate = dateInput ? dateInput.value : null;

            msgSpan.innerText = 'Updating...';

            fetch('/admin/contact-requests/' + id + '/update-status', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    status: status,
                    scheduled_date: scheduledDate
                })
            })
            .then(response => response.json())
            .then(data => {
                msgSpan.innerText = 'Updated!';
                setTimeout(() => { msgSpan.innerText = ''; }, 2000);
            })
            .catch(error => {
                console.error('Error:', error);
                msgSpan.innerText = 'Failed!';
            });
        }
    </script>

</body>
</html>