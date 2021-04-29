<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function index()
    {
        //if the user id that login is true then logedin
        if ($this->session->userdata('uId')) {
            echo 'welcome in home';
        }else{
            
            $this->session->set_flashdata('error','you have to login now');
            redirect('singin');
        }
    }
    public function logout()
    {
        $this->session->set_userdata(array('uId' =>''));
        redirect('singin');
    }
}