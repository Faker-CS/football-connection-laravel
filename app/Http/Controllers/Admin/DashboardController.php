<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'sidebarType' => 'admin-sidebar',
            'pageTitle' => 'Vue d\'ensemble',
            'stats' => [
                ['label' => 'Utilisateurs totaux', 'value' => 1248, 'color' => 'green', 'icon' => 'users', 'trend' => '+52 ce mois', 'trend_dir' => 'up'],
                ['label' => 'Clubs inscrits', 'value' => 86, 'color' => 'blue', 'icon' => 'briefcase', 'trend' => '+8 ce mois', 'trend_dir' => 'up'],
                ['label' => 'Offres publiées', 'value' => 234, 'color' => 'amber', 'icon' => 'document', 'trend' => '+18 cette semaine', 'trend_dir' => 'up'],
                ['label' => 'Candidatures', 'value' => 1856, 'color' => 'purple', 'icon' => 'trending', 'trend' => '+124 cette semaine', 'trend_dir' => 'up'],
            ],
            'recent_activity' => [
                ['text' => 'Olympique Lyonnais a publié une nouvelle offre', 'time' => 'Il y a 5 min', 'color' => 'green'],
                ['text' => 'Marc Lefebvre a postulé chez PSG', 'time' => 'Il y a 15 min', 'color' => 'blue'],
                ['text' => 'Nouveau club inscrit : FC Metz', 'time' => 'Il y a 1h', 'color' => 'amber'],
                ['text' => 'Contenu signalé par un utilisateur', 'time' => 'Il y a 2h', 'color' => 'red'],
                ['text' => 'AS Monaco a mis à jour son profil', 'time' => 'Il y a 3h', 'color' => 'green'],
            ],
            'top_clubs' => [
                ['name' => 'Paris Saint-Germain', 'initials' => 'PS', 'league' => 'Ligue 1', 'offers' => 12, 'applications' => 186],
                ['name' => 'Olympique Lyonnais', 'initials' => 'OL', 'league' => 'Ligue 1', 'offers' => 8, 'applications' => 124],
                ['name' => 'Olympique de Marseille', 'initials' => 'OM', 'league' => 'Ligue 1', 'offers' => 6, 'applications' => 98],
                ['name' => 'AS Monaco', 'initials' => 'AS', 'league' => 'Ligue 1', 'offers' => 5, 'applications' => 76],
                ['name' => 'LOSC Lille', 'initials' => 'LO', 'league' => 'Ligue 1', 'offers' => 4, 'applications' => 52],
            ],
            'moderation_alerts' => [
                ['type' => 'Contenu inapproprié', 'reporter' => 'Système automatique', 'target' => 'Publication #1234', 'severity' => 'high'],
                ['type' => 'Profil suspect', 'reporter' => 'Club OL', 'target' => 'Utilisateur #567', 'severity' => 'medium'],
            ],
        ];

        return view('admin.dashboard', $data);
    }
}
