<?php

namespace App\Http\Controllers\Club;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'sidebarType' => 'club-sidebar',
            'pageTitle' => 'Tableau de bord',
            'club' => ['name' => 'Olympique Lyonnais', 'initials' => 'OL', 'league' => 'Ligue 1'],
            'stats' => [
                ['label' => 'Offres actives', 'value' => 3, 'color' => 'green', 'icon' => 'document'],
                ['label' => 'Candidatures reçues', 'value' => 24, 'badge' => '5 nouvelles', 'badge_color' => 'red', 'color' => 'red', 'icon' => 'users'],
                ['label' => 'Vues des offres', 'value' => 312, 'trend' => '+42 cette semaine', 'trend_dir' => 'up', 'color' => 'amber', 'icon' => 'eye'],
                ['label' => 'Entretiens planifiés', 'value' => 3, 'color' => 'blue', 'icon' => 'star'],
            ],
            'active_offers' => [
                ['title' => 'Préparateur Physique', 'type' => 'CDI', 'location' => 'Lyon', 'salary' => '40-50k €', 'status' => 'Active', 'status_color' => 'green', 'applicants' => 8, 'icon_color' => 'green'],
                ['title' => 'Analyste Vidéo', 'type' => 'CDI', 'location' => 'Lyon', 'salary' => '38-45k €', 'status' => 'Active', 'status_color' => 'green', 'applicants' => 12, 'icon_color' => 'blue'],
                ['title' => 'Éducateur U17', 'type' => 'CDI', 'location' => 'Lyon', 'salary' => '32-38k €', 'status' => '4 nouveaux', 'status_color' => 'amber', 'applicants' => 4, 'icon_color' => 'amber'],
            ],
            'recent_applications' => [
                ['name' => 'Marc Lefebvre', 'initials' => 'ML', 'role' => 'Préparateur Physique', 'city' => 'Paris', 'status' => 'Nouveau', 'status_color' => 'red'],
                ['name' => 'Sophie Bernard', 'initials' => 'SB', 'role' => 'Analyste Vidéo', 'city' => 'Lyon', 'status' => 'Nouveau', 'status_color' => 'red'],
                ['name' => 'Karim Dumont', 'initials' => 'KD', 'role' => 'Éducateur U17', 'city' => 'Marseille', 'status' => 'En cours', 'status_color' => 'blue'],
                ['name' => 'Alix Renard', 'initials' => 'AR', 'role' => 'Analyste Vidéo', 'city' => 'Bordeaux', 'status' => 'Entretien', 'status_color' => 'amber'],
            ],
            'recommended_talents' => [
                ['name' => 'Pierre Dupont', 'initials' => 'PD', 'role' => 'Préparateur Physique', 'location' => 'Lyon', 'contract' => 'CDI', 'available' => true],
                ['name' => 'Laura Martin', 'initials' => 'LM', 'role' => 'Analyste Vidéo', 'location' => 'Paris', 'contract' => 'CDI', 'available' => true],
                ['name' => 'Thomas Noir', 'initials' => 'TN', 'role' => 'Éducateur U17/U19', 'location' => 'Lyon', 'contract' => 'CDI / CDD', 'available' => true],
            ],
            'nav_badges' => ['news' => 3, 'offers' => 3, 'applications' => 5],
        ];

        return view('club.dashboard', $data);
    }
}
