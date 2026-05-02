<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index()
    {
        $data = [
            'sidebarType' => 'admin-sidebar',
            'pageTitle' => 'Actualités',
            'news' => [
                ['title' => 'Journée portes ouvertes', 'author' => 'Olympique Lyonnais', 'author_type' => 'Club', 'date' => '30 Avr 2026', 'status' => 'Publié', 'status_color' => 'green'],
                ['title' => 'L\'importance de la préparation', 'author' => 'Marc Lefebvre', 'author_type' => 'Talent', 'date' => '28 Avr 2026', 'status' => 'Publié', 'status_color' => 'green'],
                ['title' => 'Recrutement : tendances 2026', 'author' => 'Paris Saint-Germain', 'author_type' => 'Club', 'date' => '25 Avr 2026', 'status' => 'En attente', 'status_color' => 'amber'],
                ['title' => 'Mon parcours de coach', 'author' => 'Sophie Bernard', 'author_type' => 'Talent', 'date' => '22 Avr 2026', 'status' => 'Rejeté', 'status_color' => 'red'],
                ['title' => 'Partenariat universitaire', 'author' => 'AS Monaco', 'author_type' => 'Club', 'date' => '20 Avr 2026', 'status' => 'Publié', 'status_color' => 'green'],
            ],
        ];

        return view('admin.news', $data);
    }
}
