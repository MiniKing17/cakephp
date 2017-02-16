<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18N\I18N;

/**
 * Employers Controller
 *
 * @property \App\Model\Table\EmployersTable $Employers
 */
class EmployersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        if ($this->request->is('post')) {
            $locale = $this->request->data('locale');
            I18N::locale($locale);
        }
        $this->paginate = [
            'contain' => ['Employees'],
            'limit' => 3
        ];
        $employers = $this->paginate($this->Employers);

        $this->set(compact('employers'));
        $this->set('_serialize', ['employers']);

        if ($this->request->is('post')) {
            $locale = $this->request->data('locale');
            I18N::locale($locale);
        }
    }

    /**
     * View method
     *
     * @param string|null $id Employer id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $employer = $this->Employers->get($id, [
            'contain' => ['Employees']
        ]);

        $this->set('employer', $employer);
        $this->set('_serialize', ['employer']);

        if ($this->request->is('post')) {
            $locale = $this->request->data('locale');
            I18N::locale($locale);
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $employer = $this->Employers->newEntity();
        if ($this->request->is('post')) {
            $employer = $this->Employers->patchEntity($employer, $this->request->data);
            if ($this->Employers->save($employer)) {
                $this->Flash->success(__('The employer has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The employer could not be saved. Please, try again.'));
            }
        }
        $employees = $this->Employers->Employees->find('list', ['limit' => 200]);
        $this->set(compact('employer', 'employees'));
        $this->set('_serialize', ['employer']);

        if ($this->request->is('post')) {
            $locale = $this->request->data('locale');
            I18N::locale($locale);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Employer id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $employer = $this->Employers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $employer = $this->Employers->patchEntity($employer, $this->request->data);
            if ($this->Employers->save($employer)) {
                $this->Flash->success(__('The employer has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The employer could not be saved. Please, try again.'));
            }
        }
        $employees = $this->Employers->Employees->find('list', ['limit' => 200]);
        $this->set(compact('employer', 'employees'));
        $this->set('_serialize', ['employer']);

        if ($this->request->is('post')) {
            $locale = $this->request->data('locale');
            I18N::locale($locale);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Employer id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $employer = $this->Employers->get($id);
        if ($this->Employers->delete($employer)) {
            $this->Flash->success(__('The employer has been deleted.'));
        } else {
            $this->Flash->error(__('The employer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
