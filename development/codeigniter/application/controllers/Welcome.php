<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


  private function layoutView($view)
  {
    $this->load->view('layout/header');
    $this->load->view($view);
    $this->load->view('layout/footer');
  }
  public function users()
  {
    $this->layoutView('welcome');
  }
  public function index()
  {
    $this->layoutView('welcome');
  }
}
