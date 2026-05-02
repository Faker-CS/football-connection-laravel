<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class OffersController extends Controller
{
    public function index()
    {
        $data = [
            'sidebarType' => 'admin-sidebar',
            'pageTitle' => 'Offres',
            'offers' => [
                ['title' => 'Préparateur Physique', 'club' => 'Olympique Lyonnais', 'club_initials' => 'OL', 'date' => '15 Avr 2026', 'applicants' => 8, 'status' => 'Active', 'status_color' => 'green'],
                ['title' => 'Analyste Vidéo', 'club' => 'Paris Saint-Germain', 'club_initials' => 'PS', 'date' => '12 Avr 2026', 'applicants' => 15, 'status' => 'Active', 'status_color' => 'green'],
                ['title' => 'Éducateur U17', 'club' => 'AS Monaco', 'club_initials' => 'AS', 'date' => '10 Avr 2026', 'applicants' => 4, 'status' => 'En attente', 'status_color' => 'amber'],
                ['title' => 'Coach Adjoint', 'club' => 'LOSC Lille', 'club_initials' => 'LO', 'date' => '08 Avr 2026', 'applicants' => 22, 'status' => 'Active', 'status_color' => 'green'],
                ['title' => 'Recruteur', 'club' => 'Stade Rennais', 'club_initials' => 'SR', 'date' => '01 Avr 2026', 'applicants' => 9, 'status' => 'Rejetée', 'status_color' => 'red'],
                ['title' => 'Kinésithérapeute', 'club' => 'FC Nantes', 'club_initials' => 'FC', 'date' => '28 Mar 2026', 'applicants' => 11, 'status' => 'Clôturée', 'status_color' => 'gray'],
            ],
        ];

        return view('admin.offers', $data);
    }
}
