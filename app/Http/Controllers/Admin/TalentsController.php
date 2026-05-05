<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class TalentsController extends Controller
{
    public function index()
    {
        $talents = [
            ['name' => 'Marc Lefebvre', 'initials' => 'ML', 'role' => 'Préparateur Physique', 'location' => 'Paris', 'applications' => 8, 'status' => 'Actif', 'status_color' => 'green', 'joined' => '10 Jan 2026'],
            ['name' => 'Sophie Bernard', 'initials' => 'SB', 'role' => 'Analyste Vidéo', 'location' => 'Lyon', 'applications' => 5, 'status' => 'Actif', 'status_color' => 'green', 'joined' => '15 Feb 2026'],
            ['name' => 'Karim Dumont', 'initials' => 'KD', 'role' => 'Éducateur', 'location' => 'Marseille', 'applications' => 3, 'status' => 'Actif', 'status_color' => 'green', 'joined' => '20 Mar 2026'],
            ['name' => 'Alix Renard', 'initials' => 'AR', 'role' => 'Analyste Vidéo', 'location' => 'Bordeaux', 'applications' => 6, 'status' => 'Actif', 'status_color' => 'green', 'joined' => '05 Apr 2026'],
            ['name' => 'Lucas Petit', 'initials' => 'LP', 'role' => 'Coach Adjoint', 'location' => 'Toulouse', 'applications' => 2, 'status' => 'Inactif', 'status_color' => 'gray', 'joined' => '12 Dec 2025'],
            ['name' => 'Emma Girard', 'initials' => 'EG', 'role' => 'Kinésithérapeute', 'location' => 'Nice', 'applications' => 4, 'status' => 'Suspendu', 'status_color' => 'red', 'joined' => '08 Nov 2025'],
        ];

        $stats = [
            'total' => count($talents),
            'active' => count(array_filter($talents, fn($talent) => $talent['status'] === 'Actif')),
            'available' => count(array_filter($talents, fn($talent) => $talent['status'] === 'Inactif')),
            'suspended' => count(array_filter($talents, fn($talent) => $talent['status'] === 'Suspendu')),
        ];

        $data = [
            'sidebarType' => 'admin-sidebar',
            'pageTitle' => 'Talents',
            'talents' => $talents,
            'stats' => $stats,
        ];

        return view('admin.talents', $data);
    }
}
