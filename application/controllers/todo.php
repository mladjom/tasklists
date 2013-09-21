<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Todo extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
    if(!$this->session->userdata('username')) {
      redirect('site/login');
    }
		
		$this->load->model('model_users');// Load our users model for our entire class	
		$this->load->model('todo_model');// Load our todo model for our entire class

	}

	public function index()
	{
		/**
		* Get site wide todos data
		*/
		//$data['get_all'] = $this->todo_model->getAll();
		//$data['get_active'] = $this->todo_model->getCompleted();
		//$data['get_completed'] = $this->todo_model->getActive(); 		
    
		//$data['all_todos'] = $this->todo_model->allTodosByUser($this->session->userdata('id'));
    
		//Here we geting user active todos 
		$data['active_todos'] = $this->todo_model->activeTodosByUser($this->session->userdata('id'));
		
		//Here we geting user completed todos 
		$data['completed_todos'] = $this->todo_model->completedTodosByUser($this->session->userdata('id'));		
 
		$data['todo_lists'] = $this->todo_model->getAllLists();
		
		$data['flash_message'] = $this->session->flashdata('message');		
		
		// Loading views
		$this->load->view('includes/header');
		$this->load->view('todo/index', $data);
		$this->load->view('includes/footer');

	}

	public function add()
	{   
		// validation rules
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'max_length[255]');
		// set error delimiters
		$this->form_validation->set_error_delimiters('<label for="inputError" class="text-warning">', '</label>');

		if ($this->form_validation->run() == FALSE)
		{
        $this->index();

		}
				
		$data['todo_lists'] = $this->todo_model->getAllLists();
 
		if ($this->form_validation->run())
        {
			$todo = array(
							'title'=>$this->input->post('title'),
							'description'=>$this->input->post('description'),
							'list_id'=>$this->input->post('list'),
							'users_id'=>$this->session->userdata('id')
							);
				$this->todo_model->add($todo);
	
				$this->session->set_flashdata('message', 'Done. You have added new task.');            
				redirect('/');
		}

	}

  public function update($id) 
	{
		$data = $this->todo_model->getById($id);
		// validation rules
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'max_length[255]');
		
		if ($this->form_validation->run())
    {
			$this->todo_model->update($id);
			$this->session->set_flashdata('message', 'Done. You have updated task.');            
			redirect('/');
		}
		else
		{
				$this->load->view('todo/update', $data);
		}
	}

		public function delete($id)
    {

        $data = $this->todo_model->getById($id);
 
        if ($this->todo_model->delete($id)) {
            $this->session->set_flashdata('message', "Done. You have deleted $data->title.");                        
        } else {
            $this->session->set_flashdata('message', "No data found. You deleted wrong to do."); 
        }
        redirect('');
 
    }

	public function add_list()
	{   
 
		// validation rules
		$this->form_validation->set_rules('list_name', 'List', 'required');
		// set error delimiters
		$this->form_validation->set_error_delimiters('<label for="inputError" class="text-warning">', '</label>');
		
		if ($this->form_validation->run() == FALSE)
		{
        $this->index();

		}
        if ($this->form_validation->run())
        {
            $todo = array(
                    'list_name'=>$this->input->post('list_name')
                    );
            $this->todo_model->addList($todo);
 
            $this->session->set_flashdata('message', 'Done. You have added a new list.');            
            redirect('/');
        }

    }
 
    public function complete($id)
    {

        $data = $this->todo_model->getById($id);
 
        if ($this->todo_model->setComplete($id)) {
            $this->session->set_flashdata('message', "You have set $data->title as complete.");                        
        } else {
            $this->session->set_flashdata('message', "No data found. You access wrong to do list.");  
        }
        redirect('');
    }

    public function incomplete($id)
    {

        $data = $this->todo_model->getById($id);
 
        if ($this->todo_model->setIncomplete($id)) {
            $this->session->set_flashdata('message', "You have set $data->title as incomplete.");                        
        } else {
            $this->session->set_flashdata('message', "No data found. You access wrong to do list.");  
        }
        redirect('');
    }
}