<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ModerationController extends Controller
{
    public function index()
    {
        $data = [
            'sidebarType' => 'admin-sidebar',
            'pageTitle' => 'Modération',
            'items' => [
                ['type' => 'Publication', 'content' => 'Contenu promotionnel non autorisé dans une publication de blog...', 'reason' => 'Spam / Publicité', 'reporter' => 'Système automatique', 'date' => '28 Avr 2026', 'severity' => 'high', 'author' => 'Utilisateur #234'],
                ['type' => 'Profil', 'content' => 'Informations de profil potentiellement fausses détectées...', 'reason' => 'Faux profil', 'reporter' => 'Club OL', 'date' => '27 Avr 2026', 'severity' => 'medium', 'author' => 'Utilisateur #567'],
                ['type' => 'Commentaire', 'content' => 'Langage inapproprié dans les commentaires d\'une offre...', 'reason' => 'Contenu inapproprié', 'reporter' => 'Utilisateur #123', 'date' => '25 Avr 2026', 'severity' => 'high', 'author' => 'Utilisateur #890'],
                ['type' => 'Offre', 'content' => 'Offre d\'emploi avec des conditions suspectes...', 'reason' => 'Offre frauduleuse', 'reporter' => 'Système automatique', 'date' => '22 Avr 2026', 'severity' => 'low', 'author' => 'Club #45'],
            ],
        ];

        return view('admin.moderation', $data);
    }
}
