<?php

namespace App\Http\Controllers\Talent;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function index()
    {
        $data = [
            'sidebarType' => 'talent-sidebar',
            'pageTitle' => 'Paramètres',
            'settings' => [
                'email' => 'marc.lefebvre@email.com',
                'notifications' => [
                    ['label' => 'Nouvelles offres correspondantes', 'enabled' => true],
                    ['label' => 'Mises à jour de candidatures', 'enabled' => true],
                    ['label' => 'Messages des clubs', 'enabled' => true],
                    ['label' => 'Newsletter hebdomadaire', 'enabled' => false],
                    ['label' => 'Rappels d\'entretiens', 'enabled' => true],
                ],
                'privacy' => [
                    ['label' => 'Profil visible par les clubs', 'enabled' => true],
                    ['label' => 'Afficher mon email', 'enabled' => false],
                    ['label' => 'Afficher mon téléphone', 'enabled' => false],
                    ['label' => 'Apparaître dans les recherches', 'enabled' => true],
                ],
            ],
        ];

        return view('talent.settings', $data);
    }
}
