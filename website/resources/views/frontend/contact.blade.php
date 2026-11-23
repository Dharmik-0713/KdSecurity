<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Audit | KdSecurity</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class', theme: { extend: { colors: { cyber: { blue: '#00f2ff', dark: '#0a0a0a' } } } } }
    </script>
</head>
<body class="bg-cyber-dark text-white font-sans antialiased min-h-screen flex flex-col items-center justify-center p-6">

    <div class="w-full max-w-lg bg-black/50 p-8 rounded-2xl border border-cyber-blue/20 backdrop-blur-md">
        <h2 class="text-3xl font-bold mb-6 text-cyber-blue">Request Security Audit</h2>
        @if(session('success'))
            <div class="bg-green-900/40 border border-green-700/50 text-green-400 px-4 py-3 rounded-lg text-sm mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Full Name</label>
                <input type="text" name="full_name" class="w-full bg-cyber-dark border border-gray-700 rounded-lg p-3 focus:border-cyber-blue outline-none" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Email Address</label>
                <input type="email" name="email" class="w-full bg-cyber-dark border border-gray-700 rounded-lg p-3 focus:border-cyber-blue outline-none" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Phone Number</label>
                <input type="tel" name="phone" placeholder="+91 98765 43210" class="w-full bg-cyber-dark border border-gray-700 rounded-lg p-3 focus:border-cyber-blue outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Website URL</label>
                <input type="url" name="website_url" placeholder="https://example.com" class="w-full bg-cyber-dark border border-gray-700 rounded-lg p-3 focus:border-cyber-blue outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Message</label>
                <textarea name="message" rows="4" class="w-full bg-cyber-dark border border-gray-700 rounded-lg p-3 focus:border-cyber-blue outline-none"></textarea>
            </div>
            <button type="submit" class="w-full bg-cyber-blue text-black font-bold py-3 rounded-lg hover:bg-white transition uppercase tracking-wider">Submit Request</button>
        </form>
        <p class="mt-4 text-center text-xs text-gray-500">Your information is confidential and will be treated with highest security.</p>
    </div>

</body>
</html>