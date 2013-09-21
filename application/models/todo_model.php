<?php
class Todo_model extends CI_Model {

	public function _construct()
	{
		// Call the Model constructor
		parent::_construct();   
	}

	/**
	 * Get todos data
	 */   
	  
	//Query the data table for every record and row
	public function getAll()
	{
		$query = $this->db->get('todos');
		return $query->result();
	}

	public function getById($id) 
	{
		// Get todos by id
		$query = $this->db->get_where('todos', array('id' => $id));
		return $query->row();
	}
	//Query the data table for active record
	public function getActive()
	{
    $where = array(
      'status' => '1'
    );
    $query = $this->db->get_where('todos', $where);
		return $query->result();
	}
	//Query the data table for completed records 
	public function getCompleted()
	{
    $where = array(
      'status' => '1'
    );
    $query = $this->db->get_where('todos', $where);
		return $query->result();
	}
	
	/**
	 * Get user todos
	 */ 
	 
  public function allTodosByUser($users_id) {
    $where = array(
      'users_id' => $users_id
    );
    $this->db->join('users', 'users.user_id = todos.users_id', 'INNER');
    $query = $this->db->get_where('todos', $where);

    if($query->num_rows() > 0) {
      return $query->result();
    } else {
      return FALSE;
    }
  }

  public function activeTodosByUser($users_id) {
    $where = array(
      'users_id' => $users_id,
      'status' => '1'
		);
    $this->db->join('users', 'users.user_id = todos.users_id', 'INNER');
    $query = $this->db->get_where('todos', $where);

    if($query->num_rows() > 0) {
      return $query->result();
    } else {
      return FALSE;
    }
  }

  public function completedTodosByUser($users_id) {
    $where = array(
      'users_id' => $users_id,
      'status' => '0'
		);
    $this->db->join('users', 'users.user_id = todos.users_id', 'INNER');
    $query = $this->db->get_where('todos', $where);

    if($query->num_rows() > 0) {
      return $query->result();
    } else {
      return FALSE;
    }
  }

	/**
	 * Get lists data
	 */
	 
	function getAllLists()
	{
		//Query the data table for every record and row
		$query = $this->db->get('todo_lists');
		return $query->result();
	}
	function getListsId($id) 
	{
		// Get lists by id
		$query = $this->db->get_where('todo_lists', array('id'=>$id));  	
		return $result[0];
	} 

	/**
	 * Get user lists
	 */

	function getUserLists()
	{
		//Query the data table for every record and row
		$query = $this->db->get('todo_lists');
		return $query->result();

    $where = array(
      'users_id' => $users_id
    );
    $this->db->join('users', 'users.user_id = todo_lists.users_id', 'INNER');
    $query = $this->db->get_where('todos', $where);

    if($query->num_rows() > 0) {
      return $query->result();
    } else {
      return FALSE;
    }



	}

	/**
	 * CRUD Todos
	 */
	public function add($data)
	{
		$this->db->insert('todos', $data); 
	}

	public function delete($id)
	{
		$query = $this->db->get_where('todos', array('id'=>$id));  

		if ($query->num_rows()==0) {
				return false;
		}
		else {
				$this->db->delete('todos', array('id' => $id)); 
				return true;
		}    
	}

	public function update($id)
	{
		$data = array(
				'title'=>$this->input->post('title'),
				'description'=>$this->input->post('description'),
				'users_id'=>$this->session->userdata('id')

		);
		$this->db->where('id', $id);
		$this->db->update('todos', $data); 
	}
	
	public function setComplete($id)
	{
        $query = $this->db->get_where('todos', array('id'=>$id));  
 
        if ($query->num_rows()==0) {
            return false;
        }
        else {
            $this->db->update('todos', array('status' => 0), array('id' => $id));
            return true;
        }   
	}
		
	public function setIncomplete($id)
	{
        $query = $this->db->get_where('todos', array('id'=>$id));  
 
        if ($query->num_rows()==0) {
            return false;
        }
        else {
            $this->db->update('todos', array('status' => 1), array('id' => $id));
            return true;
        }   
	}

	/**
	 * CRUD Lists
	 */
	public function addList($data)
	{
		$this->db->insert('todo_lists', $data); 
	}
	public function deleteList($id)
	{
			$query = $this->db->get_where('todo_lists', array('id'=>$id));  

			if ($query->num_rows()==0) {
					return false;
			}
			else {
					$this->db->delete('todo_lists', array('id' => $id)); 
					return true;
			}    
	}

}

?>
