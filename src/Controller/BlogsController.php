<?php
namespace App\Controller;

use App\Controller\AppController;

class BlogsController extends AppController
{
    public function initialize(): void
    {
      $this->loadComponent('Query');
      $this->loadComponent('Content');
      parent::initialize();
    }

    public function index()
    {
        $this->viewBuilder()->setLayout('main');

        $blogs = $this->Query->getMany('Blogs', [
            'conditions' => [
                'Blogs.is_active' => true,
                'Blogs.is_deleted' => false
            ],
            'order' => [
                'Blogs.created_at' => 'DESC'
            ],
            'contain' => ['Media']
        ]);

        $this->set('blogs', $blogs);
        $this->set('page_title', 'Blogs');
    }

    public function view($url_slug = null)
    {
        $this->viewBuilder()->setLayout('main');

        $blog = $this->Query->getOne('Blogs', [
            'conditions' => [
                'Blogs.url_slug' => $url_slug,
                'Blogs.is_active' => true,
                'Blogs.is_deleted' => false
            ],
            'contain' => ['Media']
        ]);
        if (!isset($blog['id'])) {
            $this->Flash->error('Blog not found!');
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }
        $this->set('page_title', 'Blogs');
    }
}