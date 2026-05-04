<?php

namespace App\Http\Controllers\Club;

use App\Http\Controllers\Controller;

class ApplicationsController extends Controller
{
    public function index()
    {
        $data = [
            'sidebarType' => 'club-sidebar',
            'pageTitle' => 'Candidatures reçues',
            'nav_badges' => ['news' => 3, 'offers' => 3, 'applications' => 5],
            'applications' => [
                ['name' => 'Marc Lefebvre', 'initials' => 'ML', 'role' => 'Préparateur Physique', 'offer' => 'Préparateur Physique', 'city' => 'Paris', 'date' => '28 Avr 2026', 'status' => 'Nouveau', 'status_color' => 'red', 'experience' => '8 ans'],
                ['name' => 'Sophie Bernard', 'initials' => 'SB', 'role' => 'Analyste Vidéo', 'offer' => 'Analyste Vidéo', 'city' => 'Lyon', 'date' => '27 Avr 2026', 'status' => 'Nouveau', 'status_color' => 'red', 'experience' => '5 ans'],
                ['name' => 'Karim Dumont', 'initials' => 'KD', 'role' => 'Éducateur', 'offer' => 'Éducateur U17', 'city' => 'Marseille', 'date' => '25 Avr 2026', 'status' => 'En cours', 'status_color' => 'blue', 'experience' => '6 ans'],
                ['name' => 'Alix Renard', 'initials' => 'AR', 'role' => 'Analyste Vidéo', 'offer' => 'Analyste Vidéo', 'city' => 'Bordeaux', 'date' => '22 Avr 2026', 'status' => 'Accepté', 'status_color' => 'green', 'experience' => '4 ans'],
                ['name' => 'Lucas Petit', 'initials' => 'LP', 'role' => 'Préparateur Physique', 'offer' => 'Préparateur Physique', 'city' => 'Toulouse', 'date' => '20 Avr 2026', 'status' => 'Accepté', 'status_color' => 'green', 'experience' => '10 ans'],
                ['name' => 'Emma Girard', 'initials' => 'EG', 'role' => 'Kinésithérapeute', 'offer' => 'Préparateur Physique', 'city' => 'Nice', 'date' => '18 Avr 2026', 'status' => 'Refusé', 'status_color' => 'red', 'experience' => '3 ans'],
            ],
        ];

        return view('club.applications', $data);
    }
}
