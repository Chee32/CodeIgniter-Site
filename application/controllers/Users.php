<?php
	class Users extends CI_Controller {
		public function register() {
			$data['title'] = 'Sign Up';

			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('user_name', 'User Name', 'required|callback_check_username_exists');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email_exists');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('passwordcf', 'Confirm Password', 'required|matches[password]');

			if($this->form_validation->run() === FALSE) {
				$this->load->view('templates/header');
				$this->load->view('users/register', $data);
				$this->load->view('templates/footer');
			} else {
				//Encrypt Pass
				$enc_password = md5($this->input->post('password'));

				$this->user_model->register($enc_password);
				//Set message
				$this->session->set_flashdata('success_message','You are now registered and can log in');

				redirect('/');
			}
		}

		public function check_username_exists($username) {
			$this->form_validation->set_message('check_username_exists', 'The username '. $username .' is taken. Please choose a differnt one.');

			if ($this->user_model->check_username_exists($username)) {
				return true;
			} else {
				return false;
			}
		}

		public function check_email_exists($email) {
			$this->form_validation->set_message('check_email_exists', 'The email address '. $email .' is registered. Please recover your password or choose a differnt one.');

			if ($this->user_model->check_email_exists($email)) {
				return true;
			} else {
				return false;
			}
		}

		public function login() {
			$data['title'] = 'Sign In';

			$this->form_validation->set_rules('user_name', 'User Name', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if($this->form_validation->run() === FALSE) {
				$this->load->view('templates/header');
				$this->load->view('users/login', $data);
				$this->load->view('templates/footer');
			} else {
				$username = $this->input->post('user_name');
				//Encrypt Pass
				$enc_password = md5($this->input->post('password'));

				$user = $this->user_model->login($username, $enc_password);

				if($user) {
					$user_data = array(
						'user_id' => $user['user_id'],
						'username' => $username,
						'type' => $user['type'],
						'logged_in' => true
					);

					$this->session->set_userdata($user_data);

					//Set message
					$this->session->set_flashdata('success_message','You are now logged in');

					redirect('/');
				} else {
					//Set message
					$this->session->set_flashdata('error_message','Login is invalid');

					redirect('users/login');

				}
				
			}

		}

		public function logout() {
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('type');
			$this->session->unset_userdata('logged_in');

			$this->session->set_flashdata('success_message','You are now logged out');

			redirect('users/login');
		}
	}