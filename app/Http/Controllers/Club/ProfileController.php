<?php

namespace App\Http\Controllers\Club;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        $data = [
            'sidebarType' => 'club-sidebar',
            'pageTitle' => 'Mon Club',
            'nav_badges' => ['news' => 3, 'offers' => 3, 'applications' => 5],
            'club' => [
                'name' => 'Olympique Lyonnais',
                'initials' => 'OL',
                'league' => 'Ligue 1',
                'founded' => '1950',
                'city' => 'Lyon',
                'country' => 'France',
                'stadium' => 'Groupama Stadium',
                'website' => 'https://www.ol.fr',
                'description' => 'L\'Olympique Lyonnais est un club de football français fondé en 1950, basé à Lyon. Le club évolue en Ligue 1 et dispose d\'un centre de formation reconnu.',
                'social' => ['twitter' => '@OL', 'instagram' => '@ol', 'linkedin' => 'olympique-lyonnais'],
            ],
        ];

        return view('club.profile', $data);
    }
}
