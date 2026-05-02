<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function index()
    {
        $data = [
            'sidebarType' => 'admin-sidebar',
            'pageTitle' => 'Paramètres',
            'general' => [
                'site_name' => 'Football Connect',
                'contact_email' => 'admin@footballconnect.fr',
                'support_email' => 'support@footballconnect.fr',
                'maintenance_mode' => false,
            ],
            'email_templates' => [
                ['label' => 'Email de bienvenue', 'enabled' => true],
                ['label' => 'Notification de candidature', 'enabled' => true],
                ['label' => 'Rappel d\'entretien', 'enabled' => true],
                ['label' => 'Newsletter mensuelle', 'enabled' => false],
                ['label' => 'Alerte de modération', 'enabled' => true],
            ],
            'plan_limits' => [
                ['plan' => 'Gratuit', 'max_offers' => 2, 'max_applications' => 10, 'features' => 'Basique'],
                ['plan' => 'Pro', 'max_offers' => 10, 'max_applications' => 50, 'features' => 'Avancé'],
                ['plan' => 'Premium', 'max_offers' => -1, 'max_applications' => -1, 'features' => 'Complet'],
            ],
        ];

        return view('admin.settings', $data);
    }
}
