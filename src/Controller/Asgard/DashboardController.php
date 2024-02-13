<?php

namespace App\Controller\Asgard;

use App\Controller\Asgard\AppController;

class DashboardController extends AppController
{
    public function index()
    {
        $this->viewBuilder()->setLayout('admin_main');
        $this->set('page_title', 'Dashboard');
    }
}
