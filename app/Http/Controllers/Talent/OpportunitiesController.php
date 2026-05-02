<?php

namespace App\Http\Controllers\Talent;

use App\Http\Controllers\Controller;

class OpportunitiesController extends Controller
{
    public function index()
    {
        $data = [
            'sidebarType' => 'talent-sidebar',
            'pageTitle' => 'Opportunités',
            'filters' => [
                'positions' => ['Préparateur Physique', 'Analyste Vidéo', 'Éducateur', 'Coach Adjoint', 'Recruteur', 'Kinésithérapeute'],
                'locations' => ['Paris', 'Lyon', 'Marseille', 'Bordeaux', 'Lille', 'Monaco'],
                'contracts' => ['CDI', 'CDD', 'Stage', 'Freelance'],
            ],
            'offers' => [
                ['title' => 'Préparateur Physique', 'club' => 'Olympique Lyonnais', 'club_initials' => 'OL', 'type' => 'CDI', 'location' => 'Lyon', 'salary' => '40-50k €', 'icon_color' => 'green', 'posted' => 'Il y a 2 jours', 'tags' => ['Football', 'Ligue 1', 'Temps plein']],
                ['title' => 'Analyste Vidéo', 'club' => 'Paris Saint-Germain', 'club_initials' => 'PS', 'type' => 'CDI', 'location' => 'Paris', 'salary' => '38-45k €', 'icon_color' => 'blue', 'posted' => 'Il y a 3 jours', 'tags' => ['Analyse', 'Ligue 1', 'Temps plein']],
                ['title' => 'Éducateur U17', 'club' => 'AS Monaco', 'club_initials' => 'AS', 'type' => 'CDI', 'location' => 'Monaco', 'salary' => '32-38k €', 'icon_color' => 'amber', 'posted' => 'Il y a 5 jours', 'tags' => ['Formation', 'Ligue 1']],
                ['title' => 'Coach Adjoint', 'club' => 'LOSC Lille', 'club_initials' => 'LO', 'type' => 'CDI', 'location' => 'Lille', 'salary' => '42-52k €', 'icon_color' => 'red', 'posted' => 'Il y a 1 semaine', 'tags' => ['Coaching', 'Ligue 1']],
                ['title' => 'Kinésithérapeute', 'club' => 'Stade Rennais', 'club_initials' => 'SR', 'type' => 'CDD', 'location' => 'Rennes', 'salary' => '35-40k €', 'icon_color' => 'purple', 'posted' => 'Il y a 1 semaine', 'tags' => ['Médical', 'Ligue 1']],
                ['title' => 'Recruteur Régional', 'club' => 'Girondins de Bordeaux', 'club_initials' => 'GB', 'type' => 'Freelance', 'location' => 'Bordeaux', 'salary' => '30-35k €', 'icon_color' => 'teal', 'posted' => 'Il y a 2 semaines', 'tags' => ['Recrutement', 'Ligue 2']],
            ],
        ];

        return view('talent.opportunities', $data);
    }
}
