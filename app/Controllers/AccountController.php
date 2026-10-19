<?php
namespace App\Controllers;

use App\Core\Controller;

class AccountController extends Controller
{
    public function index()
    {
        $this->render('front.account.index', [
            'page_title' => 'My Account | New Vape',
            'page_js' => 'account'
        ]);
    }
}
