<?php

namespace App\Http\Controllers\Club;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function index()
    {
        $data = [
            'sidebarType' => 'club-sidebar',
            'pageTitle' => 'Paramètres',
            'nav_badges' => ['news' => 3, 'offers' => 3, 'applications' => 5],
            'club' => ['name' => 'Olympique Lyonnais', 'email' => 'contact@ol.fr', 'plan' => 'Premium', 'plan_expiry' => '15 Dec 2026'],
            'notifications' => [
                ['label' => 'Nouvelles candidatures', 'enabled' => true],
                ['label' => 'Messages des talents', 'enabled' => true],
                ['label' => 'Rapport hebdomadaire', 'enabled' => false],
                ['label' => 'Alertes de modération', 'enabled' => true],
            ],
        ];

        return view('club.settings', $data);
    }
}
