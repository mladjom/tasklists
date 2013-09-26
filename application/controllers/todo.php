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
    
		$data['all_todos'] = $this->todo_model->allTodosByUser($this->session->userdata('user_id'));
    
		$content['user_lists'] = $this->todo_model->getUserLists($this->session->userdata('user_id'));
		
		//Here we geting user active todos 
		$data['active_todos'] = $this->todo_model->activeTodosByUser($this->session->userdata('user_id'));

		//Here we geting user completed todos 
		$data['completed_todos'] = $this->todo_model->completedTodosByUser($this->session->userdata('user_id'));		
 
		//$data['todo_lists'] = $this->todo_model->getAllLists();
		
		$data['flash_message'] = $this->session->flashdata('message');		
	    //echo json_encode($data['active_todos']);	
		// Loading views
		$this->load->view('includes/header');
		$this->load->view('includes/sidebar', $content);
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
				
 
		if ($this->form_validation->run())
        {
			$data = array(
							'title'=>$this->input->post('title'),
							'description'=>$this->input->post('description'),
							'lists_id'=>$this->input->post('list'),
							'users_id'=>$this->session->userdata('user_id')
							);
				$this->todo_model->add($data);
	
				$this->session->set_flashdata('message', 'Done. You have added new task.');            
				redirect('/');
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
	//---------------------------------
	// AJAX REQUEST, ALL TODOS
	//---------------------------------
	public function allTodos() {
		// Array of data 
		// This typically would be a call to your Model class to return a collection of objects
		$data = $this->todo_model->allTodosByUser($this->session->userdata('user_id'));
		
		// Build our view's data object
			echo json_encode($data);

		// Load the JSON view
		$this->load->view('json', $data);
	}
	//---------------------------------
	// AJAX REQUEST, ACTIVE TODOS
	//---------------------------------
	public function activeTodos() {
		// Array of data 
		// This typically would be a call to your Model class to return a collection of objects
		$data = $this->todo_model->activeTodosByUser($this->session->userdata('user_id'));
		
		// Build our view's data object
			echo json_encode($data);

		// Load the JSON view
		$this->load->view('json', $data);
	}
	//---------------------------------
	// AJAX REQUEST, COMPLETED TODOS
	//---------------------------------
	public function completedTodos() {
		// Array of data 
		// This typically would be a call to your Model class to return a collection of objects
		$data = $this->todo_model->completedTodosByUser($this->session->userdata('user_id'));
		
		// Build our view's data object
			echo json_encode($data);

		// Load the JSON view
		$this->load->view('json', $data);
	}
	
	//------------------------------------------
	// AJAX REQUEST, ACTIVE PER LIST TODOS
	//------------------------------------------
	public function activeListTodos() {
		// Array of data 
		// This typically would be a call to your Model class to return a collection of objects
		$data = $this->todo_model->activeListTodos($this->session->userdata('user_id'));
		
		// Build our view's data object
			echo json_encode($data);

		// Load the JSON view
		$this->load->view('json_lists', $data);
	}
	//------------------------------------------
	// AJAX REQUEST, COMPLETED PER LIST TODOS
	//------------------------------------------
	public function completedListTodos() {
		// Array of data 
		// This typically would be a call to your Model class to return a collection of objects
		$data = $this->todo_model->completedListTodos($this->session->userdata('user_id'));
			$data = $this->todo_model->getListsId($id);
	
		// Build our view's data object
			echo json_encode($data);

		// Load the JSON view
		$this->load->view('json_lists', $data);
	}	

	public function lists($id)
	{
	
		$data = $this->todo_model->getListsId($id);
		
		$content['user_lists'] = $this->todo_model->getUserLists($this->session->userdata('user_id'));
		$content['current_list'] = $this->todo_model->getListsId($id);
 
		$content['list_todos'] = $this->todo_model->getListTodos($id);

		$content['active_list_todos'] = $this->todo_model->activeListTodos($id);

		$content['completed_list_todos'] = $this->todo_model->completedListTodos($id);
		$content['flash_message'] = $this->session->flashdata('message');		
		
		
		// Loading views
		$this->load->view('includes/header');
		$this->load->view('includes/sidebar', $content);
		$this->load->view('todo/lists', $data);
		$this->load->view('includes/footer');

	}

		public function delete_list($id)
    {

        $data = $this->todo_model->getListsId($id);
 
        if ($this->todo_model->deleteList($id)) {
            $this->session->set_flashdata('message', "Done. You have deleted $data->list_name.");                        
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
                    'list_name'=>$this->input->post('list_name'),
										'users_id'=>$this->session->userdata('user_id')
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