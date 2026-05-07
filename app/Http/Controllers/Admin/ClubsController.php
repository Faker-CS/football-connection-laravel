<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ClubsController extends Controller
{
    private function getClubsData()
    {
        return [
            1 => [
                'id' => 1,
                'name' => 'Paris Saint-Germain',
                'initials' => 'PS',
                'league' => 'Ligue 1',
                'offers' => 12,
                'members' => 45,
                'status' => 'Actif',
                'status_color' => 'green',
                'joined' => '15 Jan 2025',
                'founded' => '1970',
                'city' => 'Paris',
                'country' => 'France',
                'stadium' => 'Parc des Princes',
                'website' => 'https://www.psg.fr',
                'description' => 'Le Paris Saint-Germain est un club de football français basé à Paris. Le club évolue en Ligue 1 depuis 1974 et est l\'un des plus grands clubs européens.',
                'social' => ['twitter' => '@PSG_inside', 'instagram' => '@psg', 'linkedin' => 'paris-saint-germain'],
                'staff_count' => 45,
                'academy_players' => 180,
                'training_grounds' => 'Camp des Loges',
                'recent_recruitments' => [
                    ['name' => 'Kylian Mbappé', 'position' => 'Attaquant', 'date' => 'Jun 2024'],
                    ['name' => 'Ousmane Dembélé', 'position' => 'Ailier', 'date' => 'Sep 2023'],
                ],
            ],
            2 => [
                'id' => 2,
                'name' => 'Olympique Lyonnais',
                'initials' => 'OL',
                'league' => 'Ligue 1',
                'offers' => 8,
                'members' => 38,
                'status' => 'Actif',
                'status_color' => 'green',
                'joined' => '20 Feb 2025',
                'founded' => '1950',
                'city' => 'Lyon',
                'country' => 'France',
                'stadium' => 'Groupama Stadium',
                'website' => 'https://www.ol.fr',
                'description' => 'L\'Olympique Lyonnais est un club de football français fondé en 1950, basé à Lyon. Le club évolue en Ligue 1 et dispose d\'un centre de formation reconnu.',
                'social' => ['twitter' => '@OL', 'instagram' => '@ol', 'linkedin' => 'olympique-lyonnais'],
                'staff_count' => 38,
                'academy_players' => 150,
                'training_grounds' => 'Centre d\'entraînement de Tola Vologe',
                'recent_recruitments' => [
                    ['name' => 'Alexandre Lacazette', 'position' => 'Attaquant', 'date' => 'Jul 2023'],
                ],
            ],
            3 => [
                'id' => 3,
                'name' => 'Olympique de Marseille',
                'initials' => 'OM',
                'league' => 'Ligue 1',
                'offers' => 6,
                'members' => 42,
                'status' => 'Actif',
                'status_color' => 'green',
                'joined' => '10 Mar 2025',
                'founded' => '1899',
                'city' => 'Marseille',
                'country' => 'France',
                'stadium' => 'Orange Vélodrome',
                'website' => 'https://www.om.fr',
                'description' => 'L\'Olympique de Marseille est un club de football français fondé en 1899. C\'est l\'un des clubs français les plus prestigieux avec un palmarès très riche.',
                'social' => ['twitter' => '@OM_Officiel', 'instagram' => '@olympiquedemarseille', 'linkedin' => 'olympique-de-marseille'],
                'staff_count' => 42,
                'academy_players' => 160,
                'training_grounds' => 'La Commanderie',
                'recent_recruitments' => [],
            ],
        ];
    }

    public function index()
    {
        $allClubs = $this->getClubsData();
        
        // Convert to simple array for list view
        $clubs = array_map(function($club) {
            return [
                'id' => $club['id'],
                'name' => $club['name'],
                'initials' => $club['initials'],
                'league' => $club['league'],
                'offers' => $club['offers'],
                'members' => $club['members'],
                'status' => $club['status'],
                'status_color' => $club['status_color'],
                'joined' => $club['joined'],
            ];
        }, $allClubs);

        $stats = [
            'total' => count($clubs),
            'verified' => count(array_filter($clubs, fn($club) => $club['status'] === 'Actif')),
            'pending' => count(array_filter($clubs, fn($club) => $club['status'] === 'En attente')),
            'suspended' => count(array_filter($clubs, fn($club) => $club['status'] === 'Suspendu')),
        ];

        $data = [
            'sidebarType' => 'admin-sidebar',
            'pageTitle' => 'Clubs',
            'clubs' => $clubs,
            'stats' => $stats,
        ];

        return view('admin.club.clubs', $data);
    }

    public function show($id)
    {
        $allClubs = $this->getClubsData();
        
        if (!isset($allClubs[$id])) {
            abort(404, 'Club not found');
        }

        $club = $allClubs[$id];

        $data = [
            'sidebarType' => 'admin-sidebar',
            'pageTitle' => $club['name'],
            'club' => $club,
        ];

        return view('admin.club.details', $data);
    }
}
