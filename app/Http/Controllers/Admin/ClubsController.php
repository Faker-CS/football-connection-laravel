<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ClubsController extends Controller
{
    public function index()
    {
        $data = [
            'sidebarType' => 'admin-sidebar',
            'pageTitle' => 'Clubs',
            'clubs' => [
                ['name' => 'Paris Saint-Germain', 'initials' => 'PS', 'league' => 'Ligue 1', 'offers' => 12, 'members' => 45, 'status' => 'Actif', 'status_color' => 'green', 'joined' => '15 Jan 2025'],
                ['name' => 'Olympique Lyonnais', 'initials' => 'OL', 'league' => 'Ligue 1', 'offers' => 8, 'members' => 38, 'status' => 'Actif', 'status_color' => 'green', 'joined' => '20 Feb 2025'],
                ['name' => 'Olympique de Marseille', 'initials' => 'OM', 'league' => 'Ligue 1', 'offers' => 6, 'members' => 42, 'status' => 'Actif', 'status_color' => 'green', 'joined' => '10 Mar 2025'],
                ['name' => 'AS Monaco', 'initials' => 'AS', 'league' => 'Ligue 1', 'offers' => 5, 'members' => 30, 'status' => 'Actif', 'status_color' => 'green', 'joined' => '05 Apr 2025'],
                ['name' => 'FC Metz', 'initials' => 'FM', 'league' => 'Ligue 2', 'offers' => 2, 'members' => 18, 'status' => 'En attente', 'status_color' => 'amber', 'joined' => '28 Avr 2026'],
                ['name' => 'SC Bastia', 'initials' => 'SC', 'league' => 'Ligue 2', 'offers' => 0, 'members' => 8, 'status' => 'Suspendu', 'status_color' => 'red', 'joined' => '10 Jun 2025'],
            ],
        ];

        return view('admin.clubs', $data);
    }
}
