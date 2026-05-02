<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ApplicationsController extends Controller
{
    public function index()
    {
        $data = [
            'sidebarType' => 'admin-sidebar',
            'pageTitle' => 'Candidatures',
            'applications' => [
                ['applicant' => 'Marc Lefebvre', 'initials' => 'ML', 'offer' => 'Préparateur Physique', 'club' => 'OL', 'date' => '28 Avr 2026', 'status' => 'En cours', 'status_color' => 'blue'],
                ['applicant' => 'Sophie Bernard', 'initials' => 'SB', 'offer' => 'Analyste Vidéo', 'club' => 'PSG', 'date' => '27 Avr 2026', 'status' => 'Nouveau', 'status_color' => 'green'],
                ['applicant' => 'Karim Dumont', 'initials' => 'KD', 'offer' => 'Éducateur U17', 'club' => 'ASM', 'date' => '25 Avr 2026', 'status' => 'Entretien', 'status_color' => 'amber'],
                ['applicant' => 'Alix Renard', 'initials' => 'AR', 'offer' => 'Coach Adjoint', 'club' => 'LOSC', 'date' => '22 Avr 2026', 'status' => 'Accepté', 'status_color' => 'green'],
                ['applicant' => 'Lucas Petit', 'initials' => 'LP', 'offer' => 'Recruteur', 'club' => 'SRFC', 'date' => '20 Avr 2026', 'status' => 'Refusé', 'status_color' => 'red'],
            ],
        ];

        return view('admin.applications', $data);
    }
}
