<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | KdSecurity</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class', theme: { extend: { colors: { cyber: { blue: '#00f2ff', dark: '#0a0a0a', sidebar: '#111111' } } } } }
    </script>
</head>
<body class="bg-cyber-dark text-white font-sans flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-cyber-sidebar border-r border-cyber-blue/10 p-6">
        <div class="text-2xl font-bold mb-10 text-white">Kd<span class="text-cyber-blue">Security</span></div>
        <nav class="space-y-4">
            <a href="#" class="block p-3 bg-cyber-blue/10 text-cyber-blue rounded-lg border-l-2 border-cyber-blue">Dashboard</a>
            <a href="#" class="block p-3 text-gray-400 hover:text-white transition">Active Audits</a>
            <a href="#" class="block p-3 text-gray-400 hover:text-white transition">Reports</a>
            <a href="#" class="block p-3 text-gray-400 hover:text-white transition">Settings</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-10 overflow-y-auto">
        <header class="mb-10 flex justify-between items-center">
            <h1 class="text-3xl font-bold">Welcome back, <span class="text-cyber-blue">Founder</span></h1>
        </header>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-cyber-sidebar p-6 rounded-xl border border-gray-800">
                <p class="text-gray-400 text-sm">Active Audits</p>
                <p class="text-3xl font-bold mt-2">04</p>
            </div>
            <div class="bg-cyber-sidebar p-6 rounded-xl border border-gray-800">
                <p class="text-gray-400 text-sm">Pending Reports</p>
                <p class="text-3xl font-bold mt-2">02</p>
            </div>
            <div class="bg-cyber-sidebar p-6 rounded-xl border border-gray-800">
                <p class="text-gray-400 text-sm">Critical Vulnerabilities</p>
                <p class="text-3xl font-bold mt-2 text-red-500">01</p>
            </div>
        </div>
    </main>

</body>
</html>