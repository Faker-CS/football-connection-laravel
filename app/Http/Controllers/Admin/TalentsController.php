<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class TalentsController extends Controller
{
    private function getTalentsData()
    {
        return [
            1 => [
                'id' => 1,
                'name' => 'Marc Lefebvre',
                'initials' => 'ML',
                'email' => 'marc.lefebvre@email.com',
                'phone' => '+33 6 12 34 56 78',
                'city' => 'Paris',
                'country' => 'France',
                'birthdate' => '15/03/1992',
                'role' => 'Préparateur Physique',
                'bio' => 'Préparateur physique certifié avec 8 ans d\'expérience dans le football professionnel. Spécialisé dans la prévention des blessures et l\'optimisation de la performance.',
                'location' => 'Paris',
                'applications' => 8,
                'status' => 'Actif',
                'status_color' => 'green',
                'joined' => '10 Jan 2026',
                'skills' => ['Préparation physique', 'Prévention blessures', 'Nutrition sportive', 'Analyse données', 'Réathlétisation', 'GPS Tracking'],
                'positions' => ['Préparateur Physique', 'Coach Fitness', 'Préparateur Athlétique'],
                'experiences' => [
                    ['title' => 'Préparateur Physique', 'club' => 'Olympique Lyonnais', 'period' => '2022 - Présent', 'description' => 'Responsable de la préparation physique de l\'équipe première'],
                    ['title' => 'Assistant Préparateur', 'club' => 'AS Saint-Étienne', 'period' => '2019 - 2022', 'description' => 'Assistant du préparateur physique pour l\'équipe réserve et U19'],
                    ['title' => 'Préparateur Physique', 'club' => 'FC Nantes', 'period' => '2017 - 2019', 'description' => 'Préparation physique du centre de formation'],
                ],
                'documents' => [
                    ['name' => 'CV_Marc_Lefebvre.pdf', 'size' => '2.4 MB', 'date' => '15 Mar 2026'],
                    ['name' => 'Diplome_STAPS.pdf', 'size' => '1.1 MB', 'date' => '10 Jan 2026'],
                    ['name' => 'Certificat_Premiers_Secours.pdf', 'size' => '0.8 MB', 'date' => '05 Dec 2025'],
                ],
            ],
            2 => [
                'id' => 2,
                'name' => 'Sophie Bernard',
                'initials' => 'SB',
                'email' => 'sophie.bernard@email.com',
                'phone' => '+33 6 98 76 54 32',
                'city' => 'Lyon',
                'country' => 'France',
                'birthdate' => '22/07/1995',
                'role' => 'Analyste Vidéo',
                'bio' => 'Analyste vidéo spécialisée dans l\'analyse tactique et la performance. 5 ans d\'expérience en clubs professionnels.',
                'location' => 'Lyon',
                'applications' => 5,
                'status' => 'Actif',
                'status_color' => 'green',
                'joined' => '15 Feb 2026',
                'skills' => ['Analyse tactique', 'Logiciels vidéo', 'Performance', 'Statistiques', 'Montage vidéo'],
                'positions' => ['Analyste Vidéo', 'Scout Vidéo'],
                'experiences' => [
                    ['title' => 'Analyste Vidéo Senior', 'club' => 'Olympique Lyonnais', 'period' => '2021 - Présent', 'description' => 'Analyse tactique et performance pour l\'équipe première'],
                ],
                'documents' => [
                    ['name' => 'CV_Sophie_Bernard.pdf', 'size' => '1.8 MB', 'date' => '10 Feb 2026'],
                ],
            ],
        ];
    }

    public function index()
    {
        $allTalents = $this->getTalentsData();
        
        // Convert to simple array for list view
        $talents = array_map(function($talent) {
            return [
                'id' => $talent['id'],
                'name' => $talent['name'],
                'initials' => $talent['initials'],
                'role' => $talent['role'],
                'location' => $talent['location'],
                'applications' => $talent['applications'],
                'status' => $talent['status'],
                'status_color' => $talent['status_color'],
                'joined' => $talent['joined'],
            ];
        }, $allTalents);

        $stats = [
            'total' => count($talents),
            'active' => count(array_filter($talents, fn($talent) => $talent['status'] === 'Actif')),
            'available' => count(array_filter($talents, fn($talent) => $talent['status'] === 'Inactif')),
            'suspended' => count(array_filter($talents, fn($talent) => $talent['status'] === 'Suspendu')),
        ];

        $data = [
            'sidebarType' => 'admin-sidebar',
            'pageTitle' => 'Talents',
            'talents' => $talents,
            'stats' => $stats,
        ];

        return view('admin.talent.talents', $data);
    }

    public function show($id)
    {
        $allTalents = $this->getTalentsData();
        
        if (!isset($allTalents[$id])) {
            abort(404, 'Talent not found');
        }

        $talent = $allTalents[$id];

        $data = [
            'sidebarType' => 'admin-sidebar',
            'pageTitle' => $talent['name'],
            'talent' => $talent,
        ];

        return view('admin.talent.details', $data);
    }
}
