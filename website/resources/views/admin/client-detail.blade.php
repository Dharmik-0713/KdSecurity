<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $client->name }} | Client File - KdSecurity Admin</title>
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
                <a href="/admin" class="block p-3 text-cyber-blue hover:text-white transition underline-offset-2 hover:underline">← Back to All Clients</a>
                <a href="/admin/contact-requests" class="block p-3 text-gray-400 hover:text-white transition">Contact Requests</a>
                <a href="/dashboard" class="block p-3 text-gray-400 hover:text-white transition">Dashboard</a>
            </nav>
        </div>
        <div class="text-xs text-gray-500">
            Logged in as <span class="text-cyber-blue">{{ session('user.name') }}</span>
        </div>
        <a href="/logout" class="text-xs text-red-400 hover:text-red-300 mt-2">Logout</a>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-10 overflow-y-auto">
        <!-- Client Profile Header -->
        <div class="flex justify-between items-start mb-8 pb-6 border-b border-gray-800">
            <div>
                <div class="flex items-center space-x-3">
                    <h1 class="text-3xl font-bold">{{ $client->name }}</h1>
                    <span class="bg-cyber-blue/10 text-cyber-blue border border-cyber-blue/30 px-3 py-1 rounded-full text-xs font-semibold">{{ ucfirst($client->status) }} Client</span>
                </div>
                <p class="text-gray-400 text-sm mt-1">Package: <span class="text-white font-medium">{{ $client->package }}</span></p>
            </div>
            <div class="text-right">
                <span class="text-xs text-gray-400 uppercase tracking-wider block">Overall Account Progress</span>
                <div class="flex items-center justify-end space-x-2 mt-1">
                    <div class="relative w-12 h-12 flex items-center justify-center">
                        <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                            <path class="text-gray-800" stroke-width="3" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                            <path class="{{ $client->overall_progress >= 100 ? 'text-green-400' : 'text-cyber-blue' }} transition-all duration-1000 ease-out" stroke-width="3" stroke-linecap="round" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" stroke-dasharray="{{ $client->overall_progress }}, 100"/>
                        </svg>
                        <span class="absolute text-xs font-bold">{{ $client->overall_progress }}%</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Financial Overview Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-cyber-sidebar p-5 rounded-xl border border-gray-800">
                <p class="text-gray-400 text-xs uppercase tracking-wider">Total Contract Value</p>
                <p class="text-2xl font-bold mt-2 text-white">${{ number_format($client->total_contract_value, 2) }} <span class="text-xs font-normal text-gray-500">{{ $client->auditTargets->count() }} Targets Scope</span></p>
            </div>
            <div class="bg-cyber-sidebar p-5 rounded-xl border border-gray-800">
                <p class="text-gray-400 text-xs uppercase tracking-wider">Payment Received</p>
                <p class="text-2xl font-bold mt-2 text-green-400">${{ number_format($client->payment_received, 2) }} <span class="text-xs font-normal text-green-600">{{ $client->payment_received > 0 ? 'Paid' : 'Awaiting' }}</span></p>
            </div>
            <div class="bg-cyber-sidebar p-5 rounded-xl border border-gray-800">
                <p class="text-gray-400 text-xs uppercase tracking-wider">Remaining Balance</p>
                <p class="text-2xl font-bold mt-2 text-red-400">${{ number_format($client->remaining_balance, 2) }} <span class="text-xs font-normal text-red-500">{{ $client->remaining_balance > 0 ? 'Due post-audit' : 'Settled' }}</span></p>
            </div>
        </div>

        <!-- Multi-Target Assessment Status -->
        <div class="bg-cyber-sidebar rounded-xl border border-gray-800 p-6 mb-10">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-xl font-bold">Target Domains Scope ({{ $client->auditTargets->count() }} Assets)</h2>
                    <p class="text-gray-400 text-xs mt-1">Generate intermediate or full vulnerability reports per target asset</p>
                    <p class="text-[11px] text-yellow-500/80 mt-2">⚠ Overall Account Progress reaches 100% only when every target asset is completed. Individual targets can be marked "Completed" without the account being closed.</p>
                </div>
                <button class="bg-cyber-blue text-black px-4 py-2 rounded-lg text-xs font-bold hover:bg-white transition">+ Add Target Domain</button>
            </div>

            <div class="space-y-4">
                @forelse($client->auditTargets as $target)
                    <div class="p-4 bg-black/40 border border-gray-800 rounded-xl flex items-center justify-between {{ $target->status !== 'completed' ? '' : 'opacity-100' }}">
                        <div class="flex items-center space-x-4">
                            @php
                                $targetBadgeColor = match($target->status) {
                                    'completed' => 'bg-green-500 text-green-500',
                                    'in_progress' => 'bg-yellow-500 text-yellow-500',
                                    default => 'bg-gray-600 text-gray-600',
                                };
                                $targetStatusText = match($target->status) {
                                    'completed' => 'Completed',
                                    'in_progress' => $target->progress . '% In Progress',
                                    default => 'Queued',
                                };
                            @endphp
                            <div class="w-3 h-3 rounded-full {{ $targetBadgeColor }} {{ $target->status === 'completed' ? 'animate-pulse' : '' }}"></div>
                            <div>
                                <p class="font-bold text-cyber-blue">{{ $target->name }} <span class="text-xs text-gray-500 ml-2">({{ $target->label }})</span></p>
                                <p class="text-xs text-gray-400">
                                    Vulnerabilities Found:
                                    <span class="text-red-400">{{ $target->critical }} Critical</span>,
                                    <span class="text-yellow-400">{{ $target->high }} High</span>,
                                    <span class="text-gray-400">{{ $target->medium }} Medium</span>,
                                    <span class="text-gray-500">{{ $target->low }} Low</span>
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-6">
                            <span class="px-3 py-1 rounded-full text-xs font-medium
                                @if($target->status === 'completed') bg-green-900/40 text-green-400 border border-green-700/50
                                @elseif($target->status === 'in_progress') bg-yellow-900/40 text-yellow-400 border border-yellow-700/50
                                @else bg-gray-800 text-gray-400 @endif">
                                {{ $targetStatusText }}
                            </span>
                            @if($target->status === 'completed')
                                <a href="/report-preview" class="bg-cyber-blue/10 border border-cyber-blue/40 text-cyber-blue px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-cyber-blue hover:text-black transition">Download Full Report</a>
                            @else
                                <a href="/report-preview" class="bg-cyber-blue/10 border border-cyber-blue/40 text-cyber-blue px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-cyber-blue hover:text-black transition">Generate Interim Report</a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="py-8 text-center text-gray-500">No targets assigned to this client yet.</div>
                @endforelse
            </div>
        </div>
    </main>

</body>
</html>
