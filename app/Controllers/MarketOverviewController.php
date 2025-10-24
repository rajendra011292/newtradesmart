<?php
namespace App\Controllers;

class MarketOverviewController
{
    public function index()
    {
        render('market/marketoverview.php', [], 'Market Overview');
    }
}