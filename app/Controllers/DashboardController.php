<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Trade;

class DashboardController
{
    private User $userModel;
    private Trade $tradeModel;

    // Container will inject Database or models if autowiring; here we type-hint models directly
    public function __construct(\App\Core\Database $db)
    {
        $this->userModel  = new User($db);
        $this->tradeModel = new Trade($db);
    }

    // Show dashboard
    public function index(): void
{
    $userId = $_SESSION['user_id'] ?? 0;
    $user = $this->userModel->findById($userId);
    $stats = $this->tradeModel->getDashboardStats($userId);

    render('trade/dashboard.php', compact('user', 'stats'), 'Dashboard');
}

}
