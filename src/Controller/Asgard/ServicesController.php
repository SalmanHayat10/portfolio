<?php

namespace App\Controller\Asgard;

use App\Controller\Asgard\AppController;

class ServicesController extends AppController
{
    public function index()
    {
        $this->viewBuilder()->setLayout('admin_main');
        $this->set('page_title', 'Dashboard');

    }
    public function add()
    {
        $this->viewBuilder()->setLayout('admin_main');
        $this->set('page_title', 'Add Services');
    }
    public function edit($id = null)
    {
        if ($id === null) {
            $this->Flash->error('Invalid Arguments.');
            return $this->redirect(array('controller' => 'Services', 'action' => 'index'));
        }
        $this->viewBuilder()->setLayout('admin_main');
        $this->set('page_title', 'Edit Services');
    }
}
