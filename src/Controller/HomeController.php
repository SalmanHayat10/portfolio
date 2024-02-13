<?php
namespace App\Controller;

use App\Controller\AppController;

class HomeController extends AppController
{   
    public function initialize(): void
    {
        $this->loadComponent('Query');

        parent::initialize();
    }
    public function index()
    {
        $this->viewBuilder()->setLayout('main');

        


        $this->loadModel('Abouts');
         $abouts = $this->Abouts->find('all')->where([
            'Abouts.is_deleted' => 0,
            'Abouts.is_active' => 1

        ])->contain(['Media'])->toArray();
        $this->set('abouts', $abouts);

        $this->loadModel('Blogs');
        $abouts = $this->Blogs->find('all')->where([
           'Blogs.is_deleted' => 0,
           'Blogs.is_active' => 1

       ])->contain(['Media'])->toArray();
       $this->set('blogs', $abouts);
        
       $recentBlogs = $this->Query->getMany('Blogs', [
        'conditions' => [
        ],
        'limit'=> 5,
        'order' => [
            'Blogs.created_at' => 'DESC'
        ],
        'contain' => ['Media']
    ]);

    $this->set('recent_blogs', $recentBlogs);

        $this->set('page_title', 'salman PortFolio');
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

        $recentBlogs = $this->Query->getMany('Blogs', [
            'conditions' => [
                'Blogs.id !=' => $blog['id']
            ],
            'limit'=> 5,
            'order' => [
                'Blogs.created_at' => 'DESC'
            ],
            'contain' => ['Media']
        ]);

        $this->set('recent_blogs', $recentBlogs);
        $this->set('blog', $blog);
        $this->set('page_title', 'Blogs');
        
    }
    public function project()
    {
        $this->viewBuilder()->setLayout('main');
        $this->set('page_title', 'projects');
    }
}
