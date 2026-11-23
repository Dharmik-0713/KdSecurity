<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services | KdSecurity</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class', theme: { extend: { colors: { cyber: { blue: '#00f2ff', dark: '#0a0a0a' } } } } }
    </script>
</head>
<body class="bg-cyber-dark text-white font-sans antialiased">

    <!-- Navigation -->
    <nav class="flex items-center justify-between p-6 bg-black/50 backdrop-blur-md border-b border-cyber-blue/20">
        <div class="text-2xl font-bold tracking-tighter text-cyber-blue"><a href="/">Kd<span class="text-white">Security</span></a></div>
        <div class="space-x-8 text-sm uppercase tracking-widest flex items-center">
            <a href="/" class="hover:text-cyber-blue transition">Home</a>
            <a href="/contact" class="bg-cyber-blue text-black px-6 py-2 rounded-full font-bold hover:bg-white transition">Get Audit</a>
        </div>
    </nav>

    <!-- Services Header -->
    <section class="py-16 text-center px-6">
        <h1 class="text-5xl font-black mb-4">OUR <span class="text-cyber-blue">SERVICES</span></h1>
        <p class="text-gray-400 max-w-2xl mx-auto text-lg">Comprehensive security assessments tailored to protect your web applications against modern cyber threats.</p>
    </section>

    <!-- Services Grid -->
    <section class="py-10 px-10 max-w-6xl mx-auto grid md:grid-cols-3 gap-8">
        <div class="p-8 border border-cyber-blue/20 rounded-xl bg-black/30 hover:border-cyber-blue transition">
            <h3 class="text-xl font-bold mb-4 text-cyber-blue">Vulnerability Assessment</h3>
            <p class="text-gray-400 text-sm">Automated and manual scanning of your live web applications to discover security misconfigurations and software flaws.</p>
        </div>
        <div class="p-8 border border-cyber-blue/20 rounded-xl bg-black/30 hover:border-cyber-blue transition">
            <h3 class="text-xl font-bold mb-4 text-cyber-blue">Penetration Testing</h3>
            <p class="text-gray-400 text-sm">Deep-dive simulated attacks (SQLi, XSS, RCE) to check how deep a hacker can penetrate your system.</p>
        </div>
        <div class="p-8 border border-cyber-blue/20 rounded-xl bg-black/30 hover:border-cyber-blue transition">
            <h3 class="text-xl font-bold mb-4 text-cyber-blue">Remediation Support</h3>
            <p class="text-gray-400 text-sm">Clear, actionable fix reports with secure code snippets to patch vulnerabilities permanently.</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center py-10 text-gray-500 text-sm border-t border-gray-900 mt-20">
        &copy; 2026 KdSecurity. All rights reserved.
    </footer>

</body>
</html>