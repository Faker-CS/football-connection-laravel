<?php

namespace App\Http\Controllers\Talent;

use App\Http\Controllers\Controller;

class ApplicationsController extends Controller
{
    public function index()
    {
        $data = [
            'sidebarType' => 'talent-sidebar',
            'pageTitle' => 'Mes Candidatures',
            'applications' => [
                ['offer' => 'Préparateur Physique', 'club' => 'Olympique Lyonnais', 'club_initials' => 'OL', 'date' => '28 Avr 2026', 'status' => 'En cours', 'status_color' => 'blue'],
                ['offer' => 'Coach Adjoint', 'club' => 'AS Saint-Étienne', 'club_initials' => 'AS', 'date' => '25 Avr 2026', 'status' => 'Nouveau', 'status_color' => 'green'],
                ['offer' => 'Préparateur Athlétique', 'club' => 'Olympique de Marseille', 'club_initials' => 'OM', 'date' => '20 Avr 2026', 'status' => 'Entretien', 'status_color' => 'amber'],
                ['offer' => 'Fitness Coach', 'club' => 'OGC Nice', 'club_initials' => 'OG', 'date' => '15 Avr 2026', 'status' => 'Refusé', 'status_color' => 'red'],
                ['offer' => 'Préparateur Physique U21', 'club' => 'FC Nantes', 'club_initials' => 'FC', 'date' => '10 Avr 2026', 'status' => 'Accepté', 'status_color' => 'green'],
                ['offer' => 'Responsable Performance', 'club' => 'Stade de Reims', 'club_initials' => 'SR', 'date' => '05 Avr 2026', 'status' => 'En cours', 'status_color' => 'blue'],
            ],
        ];

        return view('talent.applications', $data);
    }
}
