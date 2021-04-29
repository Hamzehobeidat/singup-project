<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Singup extends CI_Controller {

	public function index()
	{
        // $this->load->helper('form');
		$this->load->view('singup');
	}

    public function newUser()
    {
        //insert all the input  data in array caled $data
        $data['uFullName'] = $this->input->post('fullName'); 
        $data['uEmail'] = $this->input->post('email'); 
        $data['uPassword'] = $this->input->post('password'); 
        $data['uDate'] = date('Y-M-D h:i:sa');

        //chick if the vareaple are not empty
        if (!empty($data['uFullName']) && !empty($data['uEmail']) && !empty($data['uPassword']) ) {

            //call the checkuser methoud in this methoud i will check if the user is allready exesst in database or not
            //by combear with email  
            $checkUser =  $this->ModeSingup->checkUser($data);

            // if the result is grater than 0 then the user is allreade in database then print the error
            if ($checkUser->num_rows() > 0 ) {

                $this->session->set_flashdata('error', 'this email' .$data['uEmail'] .' is alride exist');
                return redirect()->to('singup');

            }else{

                //else create new user and send the information to (addnewuser methode) and insert in database
                $data['uPassword'] = hash('md5', $data['uPassword']);
                $data['uLink'] = random_string('alnum',20);
                $aded = $this->ModeSingup->addNewUser($data);

               if ($aded) {
                
                //then show messeag the we insert the user 
                $this->session->set_flashdata('error', 'we have inserted');
                return redirect()->to('singup');
               }else{
                $this->session->set_flashdata('error', 'something went wrong');
                return redirect()->to('singup');
               }
            }
            
        }else {
            //else chick the input is impte
            $this->session->set_flashdata('error', 'please chick the input valus');
            return redirect()->to('singup');
        }
    }
}
