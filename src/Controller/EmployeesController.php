<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18N\I18N;

/**
 * Employees Controller
 *
 * @property \App\Model\Table\EmployeesTable $Employees
 */
class EmployeesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Employers'],
            'limit' => 3
        ];
        $employees = $this->paginate($this->Employees);

        $this->set(compact('employees'));
        $this->set('_serialize', ['employees']);

        if ($this->request->is('post')) {
            $locale = $this->request->data('locale');
            I18N::locale($locale);
        }
    }

    /**
     * View method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $employee = $this->Employees->get($id, [
            'contain' => ['Employers']
        ]);

        $this->set('employee', $employee);
        $this->set('_serialize', ['employee']);

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
        $employee = $this->Employees->newEntity();
        if ($this->request->is('post')) {
            $name = $this->request->data('name');

            $employee = $this->Employees->patchEntity($employee, $this->request->data);

            $image=$this->request->data('imagem');
            move_uploaded_file($image['tmp_name'], WWW_ROOT . '/img/uploads/' . $name. '_' . $image['name']);
            $employee -> imagem = 'uploads/'. $name. '_' . $image['name'];

            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The employee could not be saved. Please, try again.'));
            }
        }
        $employers = $this->Employees->Employers->find('list', ['limit' => 200]);
        $this->set(compact('employee', 'employers'));
        $this->set('_serialize', ['employee']);

        if ($this->request->is('post')) {
            $locale = $this->request->data('locale');
            I18N::locale($locale);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $employee = $this->Employees->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $name = $this->request->data('name');

            $employee = $this->Employees->patchEntity($employee, $this->request->data);

            $image=$this->request->data('imagem');
            move_uploaded_file($image['tmp_name'], WWW_ROOT . '/img/uploads/' . $name. '_' . $image['name']);
            $employee -> imagem = 'uploads/'. $name. '_' . $image['name'];

            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The employee could not be saved. Please, try again.'));
            }
        }
        $employers = $this->Employees->Employers->find('list', ['limit' => 200]);
        $this->set(compact('employee', 'employers'));
        $this->set('_serialize', ['employee']);

        if ($this->request->is('post')) {
            $locale = $this->request->data('locale');
            I18N::locale($locale);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $employee = $this->Employees->get($id);
        if ($this->Employees->delete($employee)) {
            $this->Flash->success(__('The employee has been deleted.'));
        } else {
            $this->Flash->error(__('The employee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
