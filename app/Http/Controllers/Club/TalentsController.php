<?php

namespace App\Http\Controllers\Club;

use App\Http\Controllers\Controller;

class TalentsController extends Controller
{
    public function index()
    {
        $data = [
            'sidebarType' => 'club-sidebar',
            'pageTitle' => 'Rechercher des talents',
            'nav_badges' => ['news' => 3, 'offers' => 3, 'applications' => 5],
            'filters' => [
                'positions' => ['Préparateur Physique', 'Analyste Vidéo', 'Éducateur', 'Coach', 'Recruteur', 'Kinésithérapeute'],
                'locations' => ['Paris', 'Lyon', 'Marseille', 'Bordeaux', 'Lille'],
                'availability' => ['Disponible', 'En poste - Ouvert', 'En poste'],
            ],
            'talents' => [
                ['name' => 'Pierre Dupont', 'initials' => 'PD', 'role' => 'Préparateur Physique', 'location' => 'Lyon', 'experience' => '10 ans', 'contract' => 'CDI', 'available' => true, 'skills' => ['Préparation physique', 'GPS', 'Nutrition']],
                ['name' => 'Laura Martin', 'initials' => 'LM', 'role' => 'Analyste Vidéo', 'location' => 'Paris', 'experience' => '6 ans', 'contract' => 'CDI', 'available' => true, 'skills' => ['Analyse vidéo', 'Statistiques', 'Scouting']],
                ['name' => 'Thomas Noir', 'initials' => 'TN', 'role' => 'Éducateur U17/U19', 'location' => 'Lyon', 'experience' => '8 ans', 'contract' => 'CDI / CDD', 'available' => true, 'skills' => ['Formation', 'Coaching', 'Pédagogie']],
                ['name' => 'Sarah Leclerc', 'initials' => 'SL', 'role' => 'Kinésithérapeute', 'location' => 'Marseille', 'experience' => '5 ans', 'contract' => 'CDI', 'available' => false, 'skills' => ['Kinésithérapie', 'Réathlétisation', 'Soins']],
                ['name' => 'Antoine Morel', 'initials' => 'AM', 'role' => 'Recruteur', 'location' => 'Bordeaux', 'experience' => '12 ans', 'contract' => 'CDI', 'available' => true, 'skills' => ['Recrutement', 'Scouting', 'Réseau']],
                ['name' => 'Julie Roux', 'initials' => 'JR', 'role' => 'Coach Adjointe', 'location' => 'Lille', 'experience' => '7 ans', 'contract' => 'CDI', 'available' => true, 'skills' => ['Coaching', 'Tactique', 'Animation']],
            ],
        ];

        return view('club.talents', $data);
    }
}
