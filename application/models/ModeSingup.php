<?php 

class ModeSingup extends CI_Model {

    public function checkUser($data)
    {
        //select * from users table where the uEmail == "xyz"
        return $this->db->get_where('users',array('uEmail' => $data['uEmail']));
    }

    public function addNewUser($data)
    {
       return $this->db->insert('users',$data);
    }

    public function checkUserPassword($data)
    {
       return $this->db->get_where('users',$data)->result_array();
    }
}