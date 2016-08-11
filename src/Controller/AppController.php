<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use App\Middleware\Authencation;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize() {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->authenticate();
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event) {
        if (!array_key_exists('_serialize', $this->viewVars) &&
                in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
    /*
     * DO NOT keep the api key and secret hardcoded in the code.
     * Keep a config file and put those there.
     * Make the checking available from that config.
     * You can simplu do like in local config file:
     * define('API_KEY', 'ssfs65374utensfsj8357w');
     * define('API_SECRET', '4653udhfdhjtiykjdhjtyi79759ryhcvbnndgjdgjdgjd');
     * The best place to deifine these is: config/app.php file
     */
    public function authenticate() {
        $apiKey = $this->request->header('apiKey');
        $apiSecret = $this->request->header('apiSecret');
        $this->autoRender = false;
        $this->response->type('json');
        if (empty($apiKey) || empty($apiSecret)) {
            header('Content-Type: application/json');
            die(json_encode(array(
                'message' => 'you do not have permission to access the API',
                'data' => ''
            )));
        }
        if ($apiKey !== 'fhddfjdjetuetu5735uethhsh' || $apiSecret !== 'fssfyu5735thhetu36u367h') {
            header('Content-Type: application/json');
            die(json_encode(array(
                'message' => 'you do not have permission to access the API',
                'data' => ''
            )));
        }
    }

}
