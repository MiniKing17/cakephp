<?php 
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class UsersController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['add', 'logout']);
    }

     public function index()
     {
        $this->traducao();
        $this->set('users', $this->Users->find('all'));

        if ($this->request->is('post')) {
            $locale = $this->request->data('locale');
            I18N::locale($locale);
        }
    }

    public function view($id)
    {
        $this->traducao();
        $user = $this->Users->get($id);
        $this->set(compact('user'));

        if ($this->request->is('post')) {
            $locale = $this->request->data('locale');
            I18N::locale($locale);
        }
    }

    public function add()
    {
        $this->traducao();
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('user', $user);

        if ($this->request->is('post')) {
            $locale = $this->request->data('locale');
            I18N::locale($locale);
        }
    }
    public function login()
    {
        $this->traducao();
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }

        if ($this->request->is('post')) {
            $locale = $this->request->data('locale');
            I18N::locale($locale);
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

}