<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_list extends CI_Model {
  public function __construct() {
    parent::__construct();
  }
  
  public function all_list($users_id, $num = PER_PAGE, $start = 0) {
    $where = array(
      'users_id' => $users_id
    );
    $this->db->join('users', 'users.id = list.users_id', 'INNER');
    $this->db->join('priority', 'priority.id = list.priority_id', 'INNER');
    $this->db->order_by('date_added', 'DESC');
    $query = $this->db->get_where('list', $where, $num, $start);

    if($query->num_rows() > 0) {
      return $query->result();
    } else {
      return FALSE;
    }
  }
  
  public function list_count($users_id) {
    $where = array(
      'users_id' => $users_id
    );
    $query = $this->db->get_where('list', $where);
    if($query->num_rows() > 0) {
      return $query->num_rows();
    } else {
      return FALSE;
    }
  }

  public function list_by_id($list_id) {
    $where = array(
      'id' => $list_id
    );
    $query = $this->db->get_where('list', $where);
    
    if($query->num_rows() == 1) {
      return $query->row();
    } else {
      return FALSE;
    }
  }
  
  public function check_by_id($id, $status) {
    if($status == 0) {
      $set = array(
        'status' => 1
      );
    } else {
      $set = array(
        'status' => 0
      );
    }
    $where = array(
      'id' => $id
    );
    $query = $this->db->update('list', $set, $where);
    
    if($query) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  
  public function check_user($list_id, $users_id) {
    $where = array(
      'id' => $list_id,
      'users_id' => $users_id
    );
    $query = $this->db->get_where('list', $where);
    if($query->num_rows() == 1) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  
  public function add_task($user_id, $date) {
    $data = array(
      'users_id'      => $user_id,
      'priority_id'   => $this->input->post('priority'),
      'title'         => $this->input->post('title'),
      'date_added'    => date("Y-m-d H:i:s"),
      'date_complete' => $date,
      'status'        => 0
    );
    
    $query = $this->db->insert('list', $data);
    
    if($query) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  
  public function update_task($list_id, $date) {
    $data = array(
      'priority_id'   => $this->input->post('priority'),
      'title'         => $this->input->post('title'),
      'date_complete' => $date
    );
    
    $where = array(
      'id' => $list_id
    );
    
    $query = $this->db->update('list', $data, $where);
    
    if($query) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  
  public function remove_task($list_id) {
    $where = array(
      'id' => $list_id
    );
    
    $query = $this->db->delete('list', $where);
    
    if($query) {
      return TRUE;
    } else {
      return FALSE;
    }
    
  }

}