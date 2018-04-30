<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {
	public function index ($type = FALSE, $offest = 0) {
		
		if( $type == 'program' ) {
			$data['title'] = 'Programming Experince';
		}

		if( $type == 'website' ) {
			$data['title'] = 'Websites';
		}

		if( $type == FALSE ) {
			$data['title'] = 'Posts';
		}

		//Pagination Config
		$config['base_url'] = base_url() .'programming-exp';
		$config['total_rows'] = $this->post_model->count_posts($type);
		$config['per_page'] = 2;
		$config['uri_segment'] = 2;
		$config['attributes'] = array('class' => 'pagination-link');

		//Init Pagination
		$this->pagination->initialize($config);

		$data['posts'] = $this->post_model->get_posts_by_type($type, $config['per_page'], $offest);

		$this->load->view('templates/header');
		$this->load->view('posts/index', $data);
		$this->load->view('templates/footer');
	}

	public function view($slug = NULL) {
		$data['post'] = $this->post_model->get_posts($slug);

		if(empty($data['post'])) {
			show_404();
		}

		$data['title'] = $data['post']['Title'];

		$this->load->view('templates/header');
		$this->load->view('posts/view', $data);
		$this->load->view('templates/footer');
	}

	public function create() {
		//Check if logged in as admin
		if ($this->input->post('type') != 'admin') {
			redirect('users/login');
		}


		$data['title'] = 'Create Post';

		$data['categories'] = $this->category_model->get_categories();

		$this->form_validation->set_rules('Title', 'Title', 'required');
		$this->form_validation->set_rules('Body', 'Body', 'required');

		if($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header');
			$this->load->view('posts/create', $data);
			$this->load->view('templates/footer');
		} else {
			//Upload Image
			$config['upload_path'] = './assets/images/posts';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2048';
			$config['max_width'] = '2000';
			$config['max_height'] = '2000';

			$this->load->library('upload', $config);

			if(!$this->upload->do_upload()) {
				$errors = array('error' => $this->upload->display_errors());
				$post_image = 'noimage.jpg';
			} else {
				$data = array('upload_data' => $this->upload->data());
				$post_image = $_FILES['userfile']['name'];
			}

			$this->post_model->create_post($post_image);

			//Set message
			$this->session->set_flashdata('success_message','Your Post has been Created');
			
			redirect('posts');
		}
	}

	public function delete($id) {
		//Check if logged in as admin
		if ($this->input->post('type') != 'admin') {
			redirect('users/login');
		}

		$this->post_model->delete_program($id);

		//Set message
		$this->session->set_flashdata('success_message','Your Post has been Deleted');

		redirect('programming-exp');
	}

	public function edit($slug) {
		//Check if logged in as admin
		if ($this->input->post('type') != 'admin') {
			redirect('users/login');
		}

		$data['post'] = $this->post_model->get_posts($slug);
		$data['categories'] = $this->category_model->get_categories();

		if(empty($data['post'])) {
			show_404();
		}

		$data['title'] = 'Edit Post Entry';

		$this->load->view('templates/header');
		$this->load->view('posts/edit', $data);
		$this->load->view('templates/footer');
	}

	public function update() {
		//Check if logged in as admin
		if ($this->input->post('type') != 'admin') {
			redirect('users/login');
		}

		//Upload Image
		$config['upload_path'] = './assets/images/posts';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '2048';
		$config['max_width'] = '2000';
		$config['max_height'] = '2000';

		$this->load->library('upload', $config);

		if(!$this->upload->do_upload('userfile')) {
			$errors = array('error' => $this->upload->display_errors());
		} else {
			$data = array('upload_data' => $this->upload->data());
			$post_image = $data['upload_data']['file_name'];
		}

		$this->post_model->update_post($post_image);

		//Set message
		$this->session->set_flashdata('success_message','Your Post has been Updated');

		redirect('post/'.url_title($this->input->post('Title')));
	}
}