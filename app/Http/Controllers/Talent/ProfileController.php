<?php

namespace App\Http\Controllers\Talent;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        $data = [
            'sidebarType' => 'talent-sidebar',
            'pageTitle' => 'Mon Profil',
            'talent' => [
                'name' => 'Marc Lefebvre',
                'initials' => 'ML',
                'email' => 'marc.lefebvre@email.com',
                'phone' => '+33 6 12 34 56 78',
                'city' => 'Paris',
                'country' => 'France',
                'birthdate' => '15/03/1992',
                'role' => 'Préparateur Physique',
                'bio' => 'Préparateur physique certifié avec 8 ans d\'expérience dans le football professionnel. Spécialisé dans la prévention des blessures et l\'optimisation de la performance.',
            ],
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
        ];

        return view('talent.profile', $data);
    }
}
