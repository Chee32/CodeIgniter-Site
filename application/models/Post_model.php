<?php
	class Post_model extends CI_Model {
		public function __construct() {
			$this->load->database();
		}

		public function get_posts($slug = FALSE, $limit = FALSE, $offest = FALSE) {

			if($limit) {
				$this->db->limit($limit, $offest);
			}

			if($slug === FALSE ){
				$this->db->order_by('posts.Post_ID', 'DESC');
				$this->db->join('categories', 'categories.Cat_ID = posts.Category_id', 'left');
				$query = $this->db->get('posts');
				return $query->result_array();
			}

			$this->db->join('categories', 'categories.Cat_ID = posts.Category_id', 'left');
			$query = $this->db->get_where('posts', array('Slug' => $slug));
			return $query->row_array();
		}

		public function get_posts_by_type($type = FALSE, $limit = FALSE, $offest = FALSE) {

			if($limit) {
				$this->db->limit($limit, $offest);
			}

			$this->db->order_by('posts.Post_ID', 'DESC');
			$this->db->join('categories', 'categories.Cat_ID = posts.Category_id', 'left');

			if($type === FALSE) {
				$query = $this->db->get('posts');
				return $query->result_array();
			}

			$query = $this->db->get_where('posts', array('Type' => $type));
			return $query->result_array();
		}

		public function create_post($image) {
			$slug = url_title($this->input->post('Title'));
			$cat = ( empty($this->input->post('Category_id')) ? NULL : $this->input->post('Category_id') );

			$data = array(
				'Type' => $this->input->post('Type'),
				'Title' => $this->input->post('Title'),
				'Body' => $this->input->post('Body'),
				'Slug' => $slug,
				'Category_id' => $cat,
				'Post_image' => $image
			);

			return $this->db->insert('posts', $data);
		}

		public function delete_post($id) {
			$this->db->where('Post_ID',$id);
			$this->db->delete('posts');
			return true;
		}

		public function update_post($image = '') {
			$slug = url_title($this->input->post('Title'));
			$cat = ( empty($this->input->post('Category_id')) ? NULL : $this->input->post('Category_id') );

			$data = array(
				'Title' => $this->input->post('Title'),
				'Body' => $this->input->post('Body'),
				'Slug' => $slug,
				'Category_id' => $cat
			);

			if (!empty($image)) {
				$data['Post_image'] = $image;
			}
			

			$this->db->where('Post_ID',$this->input->post('ID'));
			return $this->db->update('posts', $data);
		}

		public function get_posts_by_category($cat_id) {
			$this->db->order_by('Post_ID', 'DESC');
			$this->db->join('categories', 'Cat_ID = Category_id');
			$query = $this->db->get_where('posts', array('Category_id' => $cat_id));
			return $query->result_array();
		}

		public function count_posts($type) {
			if ($type) {
				$this->db->where('type', $type);
				$result = $this->db->get('posts');
				return $result->num_rows();
			} else {
				return $this->db->count_all('posts');
			}
		}
	}