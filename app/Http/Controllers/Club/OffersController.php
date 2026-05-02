<?php

namespace App\Http\Controllers\Club;

use App\Http\Controllers\Controller;

class OffersController extends Controller
{
    public function index()
    {
        $data = [
            'sidebarType' => 'club-sidebar',
            'pageTitle' => 'Mes Offres',
            'nav_badges' => ['news' => 3, 'offers' => 3, 'applications' => 5],
            'offers' => [
                ['title' => 'Préparateur Physique', 'type' => 'CDI', 'location' => 'Lyon', 'salary' => '40-50k €', 'status' => 'Active', 'status_color' => 'green', 'applicants' => 8, 'views' => 156, 'date' => '15 Avr 2026'],
                ['title' => 'Analyste Vidéo', 'type' => 'CDI', 'location' => 'Lyon', 'salary' => '38-45k €', 'status' => 'Active', 'status_color' => 'green', 'applicants' => 12, 'views' => 203, 'date' => '12 Avr 2026'],
                ['title' => 'Éducateur U17', 'type' => 'CDI', 'location' => 'Lyon', 'salary' => '32-38k €', 'status' => 'Active', 'status_color' => 'green', 'applicants' => 4, 'views' => 89, 'date' => '10 Avr 2026'],
                ['title' => 'Recruteur Régional', 'type' => 'CDD', 'location' => 'Lyon', 'salary' => '28-35k €', 'status' => 'En pause', 'status_color' => 'amber', 'applicants' => 6, 'views' => 134, 'date' => '01 Mar 2026'],
                ['title' => 'Kinésithérapeute', 'type' => 'CDI', 'location' => 'Lyon', 'salary' => '35-42k €', 'status' => 'Clôturée', 'status_color' => 'gray', 'applicants' => 15, 'views' => 278, 'date' => '15 Fev 2026'],
            ],
        ];

        return view('club.offers', $data);
    }

    public function create()
    {
        $data = [
            'sidebarType' => 'club-sidebar',
            'pageTitle' => 'Publier une offre',
            'nav_badges' => ['news' => 3, 'offers' => 3, 'applications' => 5],
            'contract_types' => ['CDI', 'CDD', 'Stage', 'Freelance', 'Alternance'],
            'categories' => ['Préparation Physique', 'Analyse Vidéo', 'Éducateur/Coach', 'Recrutement', 'Médical', 'Administration', 'Communication'],
        ];

        return view('club.publish', $data);
    }
}
