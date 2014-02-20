<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App extends CI_Controller {

  public function __construct() {
    parent::__construct();
    if(!$this->session->userdata('username')) {
      redirect('site/login');
    }
  }
  
  public function index($start = 0) {
    $all_list = $this->model_list->all_list(
   	$this->session->userdata('id'), PER_PAGE, $start);
    $config['base_url'] = base_url() . 'app/index';
    $config['total_rows'] = $this->model_list->list_count($this->session->userdata('id'));
    $config['per_page'] = PER_PAGE;
    $this->pagination->initialize($config);
    $data['pages'] = $this->pagination->create_links();
			$data['gravatar'] = $this->model_users->get_user_by_id($this->session->userdata('email'));
    
    if(!$all_list) {
      if($this->uri->segment(3) > 0) {
        $start -= PER_PAGE;
        redirect('app/index/' . $start);
      } else {
        $data['content'] = 'app/empty_view';
      }
    } else {
      $data['content'] = 'app/index_view';
      
  
      foreach($all_list as $list) {
        $data['all_list']['list']['user_id'][] = $list->users_id;
        $data['all_list']['list']['username'][] = $list->username;
        $data['all_list']['list']['list_id'][] = $list->id;
        $data['all_list']['list']['title'][] = $list->title;
        $data['all_list']['list']['priority'][] = $list->level;
        $data['all_list']['list']['date_added'][] = $list->date_added;
        $data['all_list']['list']['date_complete'][] = $list->date_complete;
        $data['all_list']['list']['status'][] = $list->status;
      }
    }
		
   $this->load->view(TEMPLATE, $data);
  }
  
  public function check($list_id, $status, $uri) {
    if($this->model_list->check_user($list_id, $this->session->userdata('id'))) {
      $this->model_list->check_by_id($list_id, $status);
    }
    redirect('app/index/' . $uri);
  }
  
  public function add_todo($uri = 0) {
    $data['uri'] = $uri;
    
    $data['options'] = array(
      1 => 'High',
      2 => 'Medium',
      3 => 'Low'
    );

    for($i = 1; $i <= 31; $i++) {
      $data['day'][$i] = $i;
    }

    for($i = 1; $i <= 12; $i++) {
      $data['month'][$i] = $i;
    }

    $this_year = date('Y');
    for($i = $this_year; $i <= $this_year+20; $i++) {
      $data['year'][$i] = $i;
    }

    $data['header'] = 'Add New Item To List';
    $data['content'] = 'app/add_view';
    $this->load->view(TEMPLATE, $data);
  }
  
  public function add_validation() {
    $this->form_validation->set_rules('title', 'Task',
      'required|trim|min_length[5]|max_length[255]');
    
    $date = $this->input->post('year') . '-' . $this->input->post('month')
      . '-' . $this->input->post('day');
    
    if($this->form_validation->run()) {
      $add_task = $this->model_list->add_task($this->session->userdata('id'), $date);
      if($add_task) {
        $count = $this->model_list->list_count($this->session->userdata('id'));
        //echo $count; die(); KAKO NAPRAVITI DA MI SE POJAVI NA ZADNJEM!!!???
        if($count <= PER_PAGE) {
          redirect('app/index');
        } elseif($count % PER_PAGE == 0) {
          redirect('app/index/' . $count);
        } elseif($count % PER_PAGE != 0) {
          $count = $count + (PER_PAGE - ($count % PER_PAGE));
          redirect('app/index/' . $count);
        }
      } else {
        $this->add_todo();
      }
       
    } else {
      $this->add_todo();
    }
  }
  
  public function remove_task($list_id, $uri) {
    if($this->model_list->check_user($list_id, $this->session->userdata('id'))) {
      $this->model_list->remove_task($list_id);
      redirect('app/index/' . $uri);
    } else {
      redirect('app/index');
    }
    
  }
  
  public function edit_task($list_id, $uri = 0) {
    if($this->model_list->check_user($list_id, $this->session->userdata('id'))) {
      $data['uri'] = $uri;
      $data['content'] = 'app/edit_view';
      $data['edit_form'] = $this->model_list->list_by_id($list_id);
      list($data['form_year'], $data['form_month'], $data['form_day']) = explode('-', $data['edit_form']->date_complete);
      $this->load->view(TEMPLATE, $data);
    } else {
      redirect('app/index');
    }
  }
  
  public function edit_validation() {
    $this->form_validation->set_rules('title', 'Task',
      'required|trim|min_length[5]|max_length[255]');
    
    $date = $this->input->post('year') . '-' . $this->input->post('month')
      . '-' . $this->input->post('day');
    
    if($this->form_validation->run()) {
      $edit_task = $this->model_list->update_task($this->input->post('id'), $date);
      if($edit_task) {
        redirect('app/index/' . $this->input->post('uri'));
      } else {
        $this->edit_task($this->input->post('id'));
      }
    } else {
      $this->edit_task($this->input->post('id'));
    }
  }
  
  public function user_info() {
    $data['header'] = 'Your Info';
    $data['content'] = 'app/user_view';
    $data['user_info'] = $this->model_users->get_user_by_id($this->session->userdata('id'));
    $data['date'] = date_parse($data['user_info']->date);
    
    $this->load->view(TEMPLATE, $data);
  }
  
}