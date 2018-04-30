<?php
	class User_model extends CI_Model {
		public function __construct() {
			$this->load->database();
		}

		public function register($enc_password) {
			if (empty($this->input->post('type'))) {
				$type = 'sub';
			} else {
				$type = $this->input->post('type');
			}

			//User data
			$data = array(
				'user_name' => $this->input->post('user_name'),
				'password' => $enc_password,
				'type' => $type,
				'email' => $this->input->post('email'),
				'name' => $this->input->post('name')
			);

			return $this->db->insert('users', $data);
		}

		public function check_username_exists($username) {
			$query = $this->db->get_where('users', array('user_name' => $username));

			if( empty($query->row_array())) {
				return true;
			} else {
				return false;
			}
		}

		public function check_email_exists($email) {
			$query = $this->db->get_where('users', array('email' => $email));
			
			if( empty($query->row_array())) {
				return true;
			} else {
				return false;
			}
		}

		public function login($username, $password) {
			$this->db->where('user_name', $username);
			$this->db->where('password', $password);

			$result = $this->db->get('users');

			if($result->num_rows() == 1 ) {
				return array(
					'user_id' => $result->row(0)->User_id,
					'type' => $result->row(0)->type
				);
			} else {
				return false;
			}
		}

	}