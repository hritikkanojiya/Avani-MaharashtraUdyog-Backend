<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends CI_Controller
{
	public function index()
	{
		$isAdminLoggedIn = $this->session->userdata('admin_logged_in');
		if ((isset($isAdminLoggedIn) && $isAdminLoggedIn == 1)) {
			redirect("modules/");
		}

		$this->load->view('authentication/index.php');
	}

	public function sign_in()
	{
		$isAdminLoggedIn = $this->session->userdata('admin_logged_in');
		if ((isset($isAdminLoggedIn) && $isAdminLoggedIn == 1)) {
			redirect("modules/");
		}

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() === FALSE) {
			$response = array(
				'status' => 'error',
				'message' => $this->get_error_message(validation_errors())
			);
			echo json_encode($response);
			return;
		} else {
			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));

			$adminDetails = $this->master_model->master_get(
				"admin_details",
				array(
					'email' => $email,
					'password' => $password,
					'is_deleted' => 'false'
				),
				"*",
				false,
				2
			);

			if (!$adminDetails) {
				$response = array(
					'status' => 'error',
					'message' => "Sorry, the email or password is incorrect, please try again."
				);
				echo json_encode($response);
				return;
			}

			$this->session->set_userdata("admin_logged_in", true);
			$this->session->set_userdata("admin_details", $adminDetails[0]);

			$response = array(
				'status' => 'success',
				'message' => 'Login successful'
			);
			echo json_encode($response);
			return;
		}
	}

	public function logout()
	{
		$isAdminLoggedIn = $this->session->userdata('admin_logged_in');
		if (!(isset($isAdminLoggedIn) && $isAdminLoggedIn == 1)) {
			redirect("auth/");
		}

		$this->session->sess_destroy();
		redirect('auth/');
	}

	private function get_error_message($messageString)
	{
		$decodedString = html_entity_decode($messageString);
		$dom = new DOMDocument;
		$dom->loadHTML($decodedString);
		$pTags = $dom->getElementsByTagName('p');
		if ($pTags->length > 0) {
			$firstPTagContent = $pTags->item(0)->textContent;
			return  $firstPTagContent;
		} else {
			return "";
		}
	}
}
