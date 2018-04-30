<?php

	class Categories extends CI_Controller {

		public function index () {

			$data['title'] = 'Categories';

			$data['categories'] = $this->category_model->get_categories();

			$this->load->view('templates/header');
			$this->load->view('categories/index', $data);
			$this->load->view('templates/footer');
		}

		public function create() {
			//Check if logged in as admin
			if ($this->input->post('type') != 'admin') {
				redirect('users/login');
			}
			
			$data['title'] = 'Create Category';

			$this->form_validation->set_rules('name', 'Name', 'required');

			if ($this->form_validation->run() === FALSE) {
				$this->load->view('templates/header');
				$this->load->view('categories/create', $data);
				$this->load->view('templates/footer');
			} else {
				$this->category_model->create_category();

				//Set message
				$this->session->set_flashdata('success_message','Your Category has been created');

				redirect('categories');
			}
		}

		public function posts($cat_id) {
			$data['title'] = $this->category_model->get_category($cat_id)->name;

			$data['posts'] = $this->post_model->get_posts_by_category($cat_id);

			$this->load->view('templates/header');
			$this->load->view('posts/index', $data);
			$this->load->view('templates/footer');
		}
	}