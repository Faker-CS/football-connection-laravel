<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class StatsController extends Controller
{
    public function index()
    {
        $data = [
            'sidebarType' => 'admin-sidebar',
            'pageTitle' => 'Statistiques',
            'user_growth' => [
                ['month' => 'Jan', 'value' => 120, 'percent' => 24],
                ['month' => 'Fév', 'value' => 185, 'percent' => 37],
                ['month' => 'Mar', 'value' => 250, 'percent' => 50],
                ['month' => 'Avr', 'value' => 340, 'percent' => 68],
                ['month' => 'Mai', 'value' => 500, 'percent' => 100],
            ],
            'offer_categories' => [
                ['name' => 'Préparation Physique', 'count' => 45, 'percent' => 85, 'color' => 'green'],
                ['name' => 'Analyse Vidéo', 'count' => 38, 'percent' => 72, 'color' => 'blue'],
                ['name' => 'Éducateur/Coach', 'count' => 32, 'percent' => 60, 'color' => 'amber'],
                ['name' => 'Recrutement', 'count' => 22, 'percent' => 42, 'color' => 'purple'],
                ['name' => 'Médical', 'count' => 18, 'percent' => 34, 'color' => 'red'],
                ['name' => 'Administration', 'count' => 12, 'percent' => 23, 'color' => 'teal'],
            ],
            'platform_stats' => [
                ['label' => 'Taux de conversion', 'value' => '18.5%', 'description' => 'Candidatures / Vues d\'offres'],
                ['label' => 'Temps moyen de réponse', 'value' => '3.2 jours', 'description' => 'Clubs aux candidatures'],
                ['label' => 'Taux d\'embauche', 'value' => '12.3%', 'description' => 'Candidatures acceptées'],
                ['label' => 'Score de satisfaction', 'value' => '4.6/5', 'description' => 'Moyenne utilisateurs'],
            ],
        ];

        return view('admin.stats', $data);
    }
}
