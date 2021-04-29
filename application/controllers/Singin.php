<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Singin extends CI_Controller {
    public function index()
    {
        $this->load->view('singin');
    }

    public function chickUser()
    {
        //tack the data from input feald and store in arrat (data)
        $data['uEmail'] = $this->input->post('email',true);
        $data['uPassword'] = $this->input->post('password',true);

        //chack if the email and password is not empty
        if (!empty($data['uEmail'] )&& !empty($data['uPassword'])) {

            //if not empty make hash for the password
            $data['uPassword'] = hash('md5',$data['uPassword']);

            //then send the data to model to combear the data in database
            $user = $this->ModeSingup->checkUserPassword($data);

            if (count($user) == 1) {
                $userData['uFullName'] = $user[0]['uFullName'];
                $userData['uDate'] = $user[0]['uDate'];
                $userData['uEmail'] = $user[0]['uEmail'];
                $userData['uId'] = $user[0]['uId'];
                $this->session->set_userdata($userData);
                //if the data returend from database is match with input then go to home page
                if ($this->session->userdata('uId')) {
                    redirect('home');
                }else{
                    $this->session->set_flashdata('error','you can not login right now');
                    redirect('singin');
                }
            }
     
            //if not match then signin agane
                else if(count($user) == 0){
                    $this->session->set_flashdata('error','invalid email or password');
                            redirect('singin');
                }
            }
        
            else{
                $this->session->set_flashdata('error','please check required fields and try again');
                            redirect('singin');
                }
        }
    }
