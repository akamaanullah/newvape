<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\AdminAuth;

abstract class AdminController extends Controller
{
    /**
     * Authenticated admin user record
     * @var array|null
     */
    protected $currentAdmin = null;

    public function __construct()
    {
        // Enforce secure separate admin authentication
        AdminAuth::requireLogin();
        $this->currentAdmin = AdminAuth::user();
    }
}
