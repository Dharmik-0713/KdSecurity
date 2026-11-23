<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KdSecurity | Security Assessment Report</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body { background: white; color: black; }
            .no-print { display: none; }
        }
    </style>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-4xl mx-auto bg-white p-12 shadow-lg border-t-8 border-cyan-500">
        <!-- Header -->
        <div class="flex justify-between items-center mb-12">
            <div>
                <h1 class="text-3xl font-bold text-cyan-600">Kd<span class="text-gray-800">Security</span></h1>
                <p class="text-sm text-gray-500 uppercase tracking-widest">Professional Security Audit Report</p>
            </div>
            <div class="text-right text-sm text-gray-600">
                <p>Date: {{ date('Y-m-d') }}</p>
                <p>Status: CONFIDENTIAL</p>
            </div>
        </div>

        <!-- Summary -->
        <div class="mb-10">
            <h2 class="text-xl font-bold border-b pb-2 mb-4">Executive Summary</h2>
            <div class="grid grid-cols-3 gap-4 text-center">
                <div class="bg-red-100 p-4 rounded text-red-700">
                    <p class="text-2xl font-bold">3</p>
                    <p class="text-xs uppercase">Critical Bugs</p>
                </div>
                <div class="bg-yellow-100 p-4 rounded text-yellow-700">
                    <p class="text-2xl font-bold">5</p>
                    <p class="text-xs uppercase">Medium Risk</p>
                </div>
                <div class="bg-green-100 p-4 rounded text-green-700">
                    <p class="text-2xl font-bold">12</p>
                    <p class="text-xs uppercase">Patched</p>
                </div>
            </div>
        </div>

        <!-- Findings -->
        <div class="mb-10">
            <h2 class="text-xl font-bold border-b pb-2 mb-6">Detailed Findings</h2>

            <div class="border-l-4 border-red-500 bg-gray-50 p-6 mb-6">
                <h3 class="font-bold text-lg mb-2 text-red-600">SQL Injection</h3>
                <p class="text-sm text-gray-700 mb-4">An attacker can inject malicious SQL queries into the search bar, potentially dumping the user database.</p>
                <div class="bg-black text-white p-4 text-xs font-mono mb-4">
                    SELECT * FROM users WHERE id = '1' OR '1'='1';
                </div>
                <p class="text-sm font-bold">Recommendation: <span class="text-gray-600 font-normal">Use Prepared Statements and Parameterized Queries.</span></p>
            </div>
        </div>

        <div class="text-center text-gray-400 text-xs mt-12 border-t pt-6">
            &copy; 2026 KdSecurity. All rights reserved. Do not share without authorization.
        </div>
    </div>

</body>
</html>