<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->library('session');
        $this->user_id = $this->session->userdata('logged_in')['login_id'];
    }

    public function index() {
        $product_home_slider_bottom = $this->Product_model->product_home_slider_bottom();
        $categories = $this->Product_model->productListCategories(0);
        $data["categories"] = $categories;
        $data["product_home_slider_bottom"] = $product_home_slider_bottom;
        $customarray = [1,2];
        $this->db->where_in('id', $customarray);
        $query = $this->db->get('custome_items');
        $customeitem = $query->result();
        
        $data['shirtcustome'] = $customeitem[0];
        $data['suitcustome'] = $customeitem[1];
        
        $query = $this->db->get('sliders');
        $data['sliders'] = $query->result();
        
        $this->load->view('home', $data);
    }
    public function contactus() {
        $data['checksent'] = '';
        $this->load->view('Pages/contactus', $data);
    }
    
     public function aboutus() {
        $this->load->view('Pages/aboutus');
    }

}
