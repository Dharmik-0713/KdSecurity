<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KdSecurity | Elite Cyber Security Solutions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        cyber: {
                            blue: '#00f2ff',
                            dark: '#0a0a0a',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-cyber-dark text-white font-sans antialiased">

    <!-- Navigation -->
    <nav class="flex items-center justify-between p-6 bg-black/50 backdrop-blur-md border-b border-cyber-blue/20">
        <div class="text-2xl font-bold tracking-tighter text-cyber-blue">Kd<span class="text-white">Security</span></div>
        <div class="space-x-8 text-sm uppercase tracking-widest flex items-center">
            <a href="/services" class="hover:text-cyber-blue transition">Services</a>
            <a href="/login" class="text-gray-300 hover:text-white transition">Login</a>
            <a href="/contact" class="bg-cyber-blue text-black px-6 py-2 rounded-full font-bold hover:bg-white transition">Get Audit</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="h-screen flex flex-col items-center justify-center text-center px-4">
        <h1 class="text-6xl md:text-8xl font-black mb-6">FORTIFYING THE <br><span class="text-cyber-blue">DIGITAL FRONTIER</span></h1>
        <p class="text-gray-400 max-w-2xl mb-10 text-lg">KdSecurity provides cutting-edge vulnerability assessment and penetration testing. We secure your applications before the bad guys exploit them.</p>
        <div class="flex space-x-4">
            <a href="/contact" class="px-8 py-4 bg-cyber-blue text-black font-bold rounded-lg hover:bg-white transition">Request Penetration Test</a>
            <a href="/services" class="px-8 py-4 border border-cyber-blue text-cyber-blue font-bold rounded-lg hover:bg-cyber-blue hover:text-black transition">Our Services</a>
        </div>
    </section>

</body>
</html>