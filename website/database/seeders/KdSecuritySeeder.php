<?php

namespace Database\Seeders;

use App\Models\AuditTarget;
use App\Models\Client;
use Illuminate\Database\Seeder;

class KdSecuritySeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // TechCorp Inc. — Enterprise Multi-Target VAPT Suite
        $techcorp = Client::create([
            'name' => 'TechCorp Inc.',
            'domain' => 'techcorp.io',
            'package' => 'Enterprise Multi-Target VAPT Suite',
            'status' => 'active',
            'overall_progress' => 75,
            'total_contract_value' => 6500,
            'payment_received' => 4000,
        ]);

        AuditTarget::create([
            'client_id' => $techcorp->id,
            'name' => 'app.techcorp.io',
            'label' => 'Main Web Application',
            'status' => 'completed',
            'progress' => 100,
            'high' => 2,
            'medium' => 3,
        ]);

        AuditTarget::create([
            'client_id' => $techcorp->id,
            'name' => 'api.techcorp.io',
            'label' => 'REST API Endpoints',
            'status' => 'in_progress',
            'progress' => 60,
            'critical' => 1,
        ]);

        AuditTarget::create([
            'client_id' => $techcorp->id,
            'name' => 'admin.techcorp.io',
            'label' => 'Internal Admin Portal',
            'status' => 'in_progress',
            'progress' => 40,
        ]);

        AuditTarget::create([
            'client_id' => $techcorp->id,
            'name' => 'auth.techcorp.io',
            'label' => 'SSO Auth Server',
            'status' => 'queued',
            'progress' => 0,
        ]);

        AuditTarget::create([
            'client_id' => $techcorp->id,
            'name' => 'cdn.techcorp.io',
            'label' => 'CDN & Static Assets',
            'status' => 'queued',
            'progress' => 0,
        ]);

        // ShopEase E-Commerce
        $shopease = Client::create([
            'name' => 'ShopEase E-Commerce',
            'domain' => 'shopease.com',
            'package' => 'Standard VAPT',
            'status' => 'active',
            'overall_progress' => 40,
            'total_contract_value' => 3000,
            'payment_received' => 1500,
        ]);

        AuditTarget::create([
            'client_id' => $shopease->id,
            'name' => 'shopease.com',
            'label' => 'E-Commerce Web Application',
            'status' => 'in_progress',
            'progress' => 40,
        ]);

        // FinPay Ltd.
        $finpay = Client::create([
            'name' => 'FinPay Ltd.',
            'domain' => 'finpay.net',
            'package' => 'Standard VAPT',
            'status' => 'active',
            'overall_progress' => 65,
            'total_contract_value' => 4500,
            'payment_received' => 3000,
        ]);

        AuditTarget::create([
            'client_id' => $finpay->id,
            'name' => 'finpay.net',
            'label' => 'Payment Gateway',
            'status' => 'in_progress',
            'progress' => 65,
        ]);
    }
}