<?php

namespace App\Http\Controllers\Talent;

use App\Http\Controllers\Controller;

class PublicationsController extends Controller
{
    public function index()
    {
        $data = [
            'sidebarType' => 'talent-sidebar',
            'pageTitle' => 'Publications',
            'publications' => [
                ['title' => 'L\'importance de la préparation physique moderne', 'excerpt' => 'Découvrez comment les nouvelles technologies transforment la préparation physique dans le football professionnel...', 'date' => '28 Avr 2026', 'status' => 'Publié', 'status_color' => 'green', 'views' => 234],
                ['title' => 'Prévention des blessures : guide complet', 'excerpt' => 'Un guide détaillé sur les meilleures pratiques pour prévenir les blessures musculaires chez les footballeurs...', 'date' => '20 Avr 2026', 'status' => 'Publié', 'status_color' => 'green', 'views' => 189],
                ['title' => 'GPS et tracking : optimiser la performance', 'excerpt' => 'Comment utiliser les données GPS pour améliorer les performances individuelles et collectives...', 'date' => '15 Avr 2026', 'status' => 'Brouillon', 'status_color' => 'gray', 'views' => 0],
            ],
        ];

        return view('talent.publications', $data);
    }
}
