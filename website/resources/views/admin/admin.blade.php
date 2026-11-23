<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | KdSecurity</title>
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
                <a href="/admin" class="block p-3 bg-cyber-blue/10 text-cyber-blue rounded-lg border-l-2 border-cyber-blue">Client Management</a>
                <a href="/admin/contact-requests" class="block p-3 text-gray-400 hover:text-white transition">Contact Requests</a>
                <a href="/dashboard" class="block p-3 text-gray-400 hover:text-white transition">Client View Preview</a>
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
                <h1 class="text-3xl font-bold">Admin Control Panel</h1>
                <p class="text-gray-400 text-sm mt-1">Manage client audits, progress tracking, and security reports</p>
            </div>
        </header>

        <!-- Quick Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
            <div class="bg-cyber-sidebar p-5 rounded-xl border border-gray-800">
                <p class="text-gray-400 text-xs uppercase tracking-wider">Total Clients</p>
                <p class="text-3xl font-bold mt-2">{{ $totalClients }}</p>
            </div>
            <div class="bg-cyber-sidebar p-5 rounded-xl border border-gray-800">
                <p class="text-gray-400 text-xs uppercase tracking-wider">In Progress Audits</p>
                <p class="text-3xl font-bold mt-2 text-cyber-blue">{{ $inProgressAudits }}</p>
            </div>
            <div class="bg-cyber-sidebar p-5 rounded-xl border border-gray-800">
                <p class="text-gray-400 text-xs uppercase tracking-wider">Completed Projects</p>
                <p class="text-3xl font-bold mt-2 text-green-400">{{ $completedProjects }}</p>
            </div>
            <div class="bg-cyber-sidebar p-5 rounded-xl border border-gray-800">
                <p class="text-gray-400 text-xs uppercase tracking-wider">Pending Reports</p>
                <p class="text-3xl font-bold mt-2 text-yellow-500">{{ $pendingReports }}</p>
            </div>
        </div>

        <!-- Clients & Progress Section -->
        <div class="bg-cyber-sidebar rounded-xl border border-gray-800 p-6">
            <h2 class="text-xl font-bold mb-6">Client Audit Status Tracker</h2>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-800 text-gray-400 text-xs uppercase tracking-wider">
                            <th class="pb-4">Client / Company</th>
                            <th class="pb-4">Target Website</th>
                            <th class="pb-4">Progress (%)</th>
                            <th class="pb-4">Audit Status</th>
                            <th class="pb-4">Report</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800 text-sm">
                        @forelse($clients as $client)
                            <tr>
                                <td class="py-4 font-semibold">
                                    <a href="{{ route('admin.client-detail', $client->id) }}" class="text-cyber-blue hover:text-white transition underline-offset-2 hover:underline">{{ $client->name }}</a>
                                </td>
                                <td class="py-4 text-cyber-blue">{{ $client->domain }}</td>
                                <td class="py-4 w-48">
                                    <div class="flex items-center space-x-2">
                                        <div class="relative w-10 h-10 flex items-center justify-center">
                                            <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                                                <path class="text-gray-800" stroke-width="3" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                                                <path class="{{ $client->overall_progress >= 100 ? 'text-green-400' : 'text-cyber-blue' }} transition-all duration-1000 ease-out" stroke-width="3" stroke-linecap="round" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" stroke-dasharray="{{ $client->overall_progress }}, 100"/>
                                            </svg>
                                            <span class="absolute text-[10px] font-bold">{{ $client->overall_progress }}</span>
                                        </div>
                                        <span class="text-xs">{{ $client->overall_progress }}%</span>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        @if($client->status === 'completed') bg-green-900/50 text-green-400
                                        @elseif($client->status === 'active') bg-blue-900/50 text-blue-400
                                        @elseif($client->status === 'in_progress') bg-yellow-900/50 text-yellow-400
                                        @else bg-gray-900/50 text-gray-400 @endif">
                                        {{ ucfirst($client->status) }}
                                    </span>
                                </td>
                                <td class="py-4 text-gray-500">
                                    @if($client->overall_progress >= 100) Completed
                                    @elseif($client->overall_progress > 0) Drafting
                                    @else Pending @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-gray-500">No clients found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>
</html>
