<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller\Asgard;
use Cake\Event\EventInterface;
use Cake\Controller\Controller;
use Firebase\JWT\JWT;
use Cake\Utility\Security;
use Cake\Routing\Router;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler',[
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');

        $this->loadComponent('Auth',[
            'authError' => "Please login to continue.",
            'loginRedirect' => [
                'controller' => 'Dashboard',
                'action' => 'index',
                'plugin' => false
            ],
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'username',
                        'password' => 'password',
                    ],
                    'userModel' => 'Admins'
                ]
            ],
            'loginAction' => [
                'controller' => 'Admins',
                'action' => 'login'
            ],
            'unauthorizedRedirect' => $this->referer(),
            'storage' => [
                'className' => 'Session',
                'key' => 'Auth.Admin',
            ]
        ]);
        $this->Auth->allow(['login']);
        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }


    /**
     * Before Filter
     * 
     * @return void
     */
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->user = $this->Auth->user();
        $this->set('user', $this->Auth->user());

        if(isset($this->user['id'])) {
            //Generate AccessToken
            $accessToken = JWT::encode([
                'sub' => $this->user['id'],
                'exp' =>  time() + (60 * 30) // 60 SECONDS * 10 = 10 Mins
              ],
            Security::getSalt());
            $this->set('ACCESS_TOKEN', $accessToken);
        }
    }
}
