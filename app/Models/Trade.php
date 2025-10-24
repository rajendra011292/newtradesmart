<?php
namespace App\Models;

use App\Core\Database;

class Trade
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    // count all trades for a user
    public function countByUser(int $userId): int
    {
        $row = $this->db->fetchOne("SELECT COUNT(*) AS cnt FROM trades WHERE user_id = :uid", [':uid'=>$userId]);
        return (int)($row['cnt'] ?? 0);
    }

    public function countWinningByUser(int $userId): int
    {
        $row = $this->db->fetchOne("SELECT COUNT(*) AS cnt FROM trades WHERE user_id = :uid AND net_profit > 0", [':uid'=>$userId]);
        return (int)($row['cnt'] ?? 0);
    }

    public function countLosingByUser(int $userId): int
    {
        $row = $this->db->fetchOne("SELECT COUNT(*) AS cnt FROM trades WHERE user_id = :uid AND net_profit <= 0", [':uid'=>$userId]);
        return (int)($row['cnt'] ?? 0);
    }

    public function averageRRByUser(int $userId): float
    {
        $row = $this->db->fetchOne("SELECT AVG(risk_reward_ratio) AS avg_rr FROM trades WHERE user_id = :uid", [':uid'=>$userId]);
        return (float)($row['avg_rr'] ?? 0.0);
    }

    // monthly P/L for last N months: returns ['2025-04'=>123.4, ...]
    public function monthlyPLByUser(int $userId, int $months = 6): array
    {
        $rows = $this->db->fetchAll(
            "SELECT DATE_FORMAT(closed_at, '%Y-%m') AS ym, SUM(net_profit) AS total
             FROM trades
             WHERE user_id = :uid AND closed_at IS NOT NULL
             GROUP BY ym
             ORDER BY ym DESC
             LIMIT :limit",
            [':uid'=>$userId, ':limit'=>$months] // note: LIMIT param may require casting; use execute with PDO bindValue if needed
        );
        $out = [];
        foreach ($rows as $r) { $out[$r['ym']] = (float)$r['total']; }
        return $out;
    }

    public function recentByUser(int $userId, int $limit = 10): array
    {
        return $this->db->fetchAll(
            "SELECT id, symbol, entry_price, exit_price, net_profit, status, closed_at
             FROM trades
             WHERE user_id = :uid
             ORDER BY created_at DESC
             LIMIT :limit",
            [':uid'=>$userId, ':limit'=>$limit]
        );
    }
    public function getDashboardStats(int $userId): array
    {
        $totalTrades = $this->countByUser($userId);
        $winningTrades = $this->countWinningByUser($userId);
        $losingTrades = $this->countLosingByUser($userId);
        $avgRR = $this->averageRRByUser($userId);
        $monthlyPL = $this->monthlyPLByUser($userId, 6);
        $recentTrades = $this->recentByUser($userId, 10);
        return [
            'total_trades' => $totalTrades,
            'winning_trades' => $winningTrades,
            'losing_trades' => $losingTrades,
            'avg_rr' => $avgRR,
            'monthly_pl' => $monthlyPL,
            'recent_trades' => $recentTrades,
        ];
    }
    
}
