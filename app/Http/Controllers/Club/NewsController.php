<?php

namespace App\Http\Controllers\Club;

use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index()
    {
        $data = [
            'sidebarType' => 'club-sidebar',
            'pageTitle' => 'Actualités & Événements',
            'nav_badges' => ['news' => 3, 'offers' => 3, 'applications' => 5],
            'news' => [
                ['title' => 'Journée portes ouvertes du centre de formation', 'excerpt' => 'Venez découvrir nos installations et rencontrer notre staff technique lors de notre journée portes ouvertes...', 'date' => '30 Avr 2026', 'status' => 'Publié', 'status_color' => 'green', 'type' => 'Événement'],
                ['title' => 'Recrutement : 3 nouveaux postes ouverts', 'excerpt' => 'L\'Olympique Lyonnais recherche activement de nouveaux talents pour renforcer son staff technique...', 'date' => '25 Avr 2026', 'status' => 'Publié', 'status_color' => 'green', 'type' => 'Actualité'],
                ['title' => 'Partenariat avec l\'Université de Lyon', 'excerpt' => 'Un nouveau partenariat académique pour la formation continue de notre staff...', 'date' => '20 Avr 2026', 'status' => 'Brouillon', 'status_color' => 'gray', 'type' => 'Actualité'],
                ['title' => 'Conférence : L\'avenir du recrutement sportif', 'excerpt' => 'Notre directeur sportif interviendra lors de la conférence annuelle sur le recrutement...', 'date' => '15 Avr 2026', 'status' => 'Publié', 'status_color' => 'green', 'type' => 'Événement'],
            ],
        ];

        return view('club.news', $data);
    }
}
