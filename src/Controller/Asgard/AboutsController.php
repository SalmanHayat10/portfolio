<?php

namespace App\Controller\Asgard;

use App\Controller\Asgard\AppController;

class AboutsController extends AppController
{
    public function index()
    {
        $this->viewBuilder()->setLayout('admin_main');
        $where = [
            // 'Reviews.is_active' => 1,
            'Abouts.is_deleted' => 0
        ];
    }
    public function add()
    {
        $this->viewBuilder()->setLayout('admin_main');
        $this->set('page_title', 'Add About');
        
    }
    public function edit($id = null)
    {
        if ($id === null) {
            $this->Flash->error('Invalid Arguments.');
            return $this->redirect(array('controller' => 'Abouts', 'action' => 'index'));
        }
        $this->viewBuilder()->setLayout('admin_main');
        $this->set('page_title', 'Edit About');
    }
}
