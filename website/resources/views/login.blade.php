<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | KdSecurity</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class', theme: { extend: { colors: { cyber: { blue: '#00f2ff', dark: '#0a0a0a' } } } } }
    </script>
</head>
<body class="bg-cyber-dark text-white font-sans flex items-center justify-center min-h-screen p-6">

    <div class="w-full max-w-md bg-black/60 p-8 rounded-2xl border border-cyber-blue/20 backdrop-blur-md shadow-2xl">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-cyber-blue">Kd<span class="text-white">Security</span></h1>
            <p class="text-gray-400 text-sm mt-2 uppercase tracking-widest">Founder Command Center</p>
        </div>

        <form action="/login" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1 text-gray-300">Admin Email</label>
                <input type="email" name="email" class="w-full bg-cyber-dark border border-gray-700 rounded-lg p-3 focus:border-cyber-blue outline-none" placeholder="founder@kdsecurity.com" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1 text-gray-300">Password</label>
                <input type="password" name="password" class="w-full bg-cyber-dark border border-gray-700 rounded-lg p-3 focus:border-cyber-blue outline-none" placeholder="••••••••" required>
            </div>
            @if($error = session('error'))
                <p class="text-red-400 text-xs">{{ $error }}</p>
            @endif
            @if($success = session('success'))
                <p class="text-green-400 text-xs">{{ $success }}</p>
            @endif
            <button type="submit" class="w-full bg-cyber-blue text-black font-bold py-3 rounded-lg hover:bg-white transition uppercase tracking-wider">Access Dashboard</button>
        </form>
    </div>

</body>
</html>