<?php

namespace App\Controller\Asgard;

use App\Controller\Asgard\AppController;

class AdminsController extends AppController
{
    public function initialize(): void
    {
      $this->loadComponent('Query');
      $this->loadComponent('Special');
      $this->loadComponent('Media');
      parent::initialize();
    }

    public function index(){
        $this->viewBuilder()->setLayout('admin_main');
        $this->set('page_title', 'Admins');
    }
    
    public function login()
    {
        $this->viewBuilder()->setLayout('admin_login');
        $this->set('page_title', 'Admins Login');
        if (!empty($this->Auth->user())) {
            return $this->redirect($this->Auth->redirectUrl());
        }
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $admin = $this->Auth->identify();
           
            if(isset($admin['id']) && $admin['is_active'] == 0){
                return $this->Flash->error('Your username or password is incorrect.');
            }
            try {
                if ($admin) {
                    if(!empty($admin['media_id'])){
                        $media = $this->Query->getOne('Media',[
                            'conditions'=>[
                                'Media.id'=>$admin['media_id']
                            ]
                        ]);
                        if(isset($media['id'])){
                            $admin['media'] = $media; 
                        }
                    }
                    $this->Auth->setUser($admin);
                    $this->Flash->success('LoggedIn Successfully!');
                    return $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
                } else {
                    $this->Flash->error('Your username or password is incorrect.');
                }
                //code...
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }

    public function add()
    {
        $this->viewBuilder()->setLayout('admin_main');
        $this->set('page_title', 'Add Admin');
    }
    
    public function edit($id = null)
    {
        if ($id === null) {
            $this->Flash->error('Invalid Arguments.');
            return $this->redirect(array('controller' => 'Admins', 'action' => 'index'));
        }
        $this->viewBuilder()->setLayout('admin_main');
        $this->set('page_title', 'Edit Admin');
    }

    public function logout(){
        // $this->RememberMe->removeUserData('RememberMe');
        return $this->redirect($this->Auth->logout());
    }

    public function change_password()
    {
        $this->viewBuilder()->setLayout('admin_main');
        $this->set('page_title', 'Change Password');
    }
}
