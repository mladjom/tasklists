<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_users extends CI_Model {
  public function __construct() {
    parent::__construct();
  }
  
  public function user_login() {
    $where = array(
      'username' => $this->input->post('username'),
      'password' => md5($this->input->post('password')),
      'active'   => 1
    );
    
    $query = $this->db->get_where('users', $where);

    if($query->num_rows() == 1) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  
  public function add_user($key) {

    $data = array(
      'username'          => $this->input->post('username'),
      'password'          => md5($this->input->post('password')),
      'email'             => $this->input->post('email'),
      'date'              => date("Y-m-d H:i:s"),
      'active'            => 0,
      'activation_string' => $key
    );
    
    $query = $this->db->insert('users', $data);
    
    if($query) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  
  public function activate_user($key) {
    $data = array(
      'active' => 1,
      'activation_string' => NULL
    );
    
    $this->db->where('activation_string', $key);
    $query = $this->db->update('users', $data);
    
    if($query) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  
  public function get_user_by_key($key) {
    $where = array(
      'activation_string' => $key
    );
    $query = $this->db->get_where('users', $where);
        
    if($query->num_rows() == 1) {
      return $query->row();
    } else {
      return FALSE;
    }
  }
  
  public function get_user_by_username($username) {
    $where = array(
      'username' => $username
    );
    $query = $this->db->get_where('users', $where);
        
    if($query->num_rows() == 1) {
      return $query->row();
    } else {
      return FALSE;
    }
  }
  
  public function get_user_by_id($id) {
    $where = array(
      'id' => $id
    );
    $query = $this->db->get_where('users', $where);
        
    if($query->num_rows() == 1) {
      return $query->row();
    } else {
      return FALSE;
    }
  }
    
}