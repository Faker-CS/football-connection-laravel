<?php

namespace App\Http\Controllers\Talent;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'sidebarType' => 'talent-sidebar',
            'pageTitle' => 'Tableau de bord',
            'talent' => [
                'name' => 'Marc Lefebvre',
                'initials' => 'ML',
                'role' => 'Préparateur Physique',
                'profile_completion' => 75,
            ],
            'stats' => [
                ['label' => 'Offres recommandées', 'value' => 12, 'color' => 'green', 'icon' => 'briefcase', 'trend' => '+3 cette semaine', 'trend_dir' => 'up'],
                ['label' => 'Candidatures envoyées', 'value' => 8, 'color' => 'blue', 'icon' => 'document'],
                ['label' => 'Vues du profil', 'value' => 156, 'color' => 'amber', 'icon' => 'eye', 'trend' => '+28 cette semaine', 'trend_dir' => 'up'],
                ['label' => 'Entretiens planifiés', 'value' => 2, 'color' => 'purple', 'icon' => 'star'],
            ],
            'recommended_offers' => [
                ['title' => 'Préparateur Physique', 'club' => 'Olympique Lyonnais', 'club_initials' => 'OL', 'type' => 'CDI', 'location' => 'Lyon', 'salary' => '40-50k €', 'icon_color' => 'green', 'posted' => 'Il y a 2 jours'],
                ['title' => 'Coach Fitness', 'club' => 'Paris Saint-Germain', 'club_initials' => 'PS', 'type' => 'CDI', 'location' => 'Paris', 'salary' => '45-55k €', 'icon_color' => 'blue', 'posted' => 'Il y a 3 jours'],
                ['title' => 'Préparateur Physique U19', 'club' => 'AS Monaco', 'club_initials' => 'AS', 'type' => 'CDD', 'location' => 'Monaco', 'salary' => '35-42k €', 'icon_color' => 'amber', 'posted' => 'Il y a 5 jours'],
            ],
            'recent_applications' => [
                ['offer' => 'Préparateur Physique', 'club' => 'OL', 'date' => '28 Avr 2026', 'status' => 'En cours', 'status_color' => 'blue'],
                ['offer' => 'Coach Adjoint', 'club' => 'ASSE', 'date' => '25 Avr 2026', 'status' => 'Nouveau', 'status_color' => 'green'],
                ['offer' => 'Préparateur Athlétique', 'club' => 'OM', 'date' => '20 Avr 2026', 'status' => 'Entretien', 'status_color' => 'amber'],
                ['offer' => 'Fitness Coach', 'club' => 'OGC Nice', 'date' => '15 Avr 2026', 'status' => 'Refusé', 'status_color' => 'red'],
            ],
        ];

        return view('talent.dashboard', $data);
    }
}
