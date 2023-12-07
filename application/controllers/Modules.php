<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Modules extends CI_Controller
{
	public function index()
	{
		$isAdminLoggedIn = $this->session->userdata('admin_logged_in');
		if (!(isset($isAdminLoggedIn) && $isAdminLoggedIn == 1)) {
			redirect("auth/");
		}

		redirect("modules/franchise/");
	}

	public function franchise()
	{
		$isAdminLoggedIn = $this->session->userdata('admin_logged_in');
		if (!(isset($isAdminLoggedIn) && $isAdminLoggedIn == 1)) {
			redirect("auth/");
		}

		$this->load->view('modules/franchise.php');
	}

	public function save_franchise()
	{
		$isAdminLoggedIn = $this->session->userdata('admin_logged_in');
		if (!(isset($isAdminLoggedIn) && $isAdminLoggedIn == 1)) {
			redirect("auth/");
		}

		$this->form_validation->set_rules('franchise_name', 'Franchise Name', 'trim|required');

		if ($this->form_validation->run() === FALSE) {
			$response = array(
				'status' => 'error',
				'message' => validation_errors()
			);
			echo json_encode($response);
			return;
		} else {
			$businessName = !empty($this->input->post('franchise_name')) ? $this->input->post('franchise_name') : NULL;
			$businessDetails = !empty($this->input->post('franchise_business_details')) ? $this->input->post('franchise_business_details') : NULL;
			$investmentDetails = !empty($this->input->post('franchise_investment_details')) ? $this->input->post('franchise_investment_details') : NULL;
			$royaltyCommision = !empty($this->input->post('franchise_royalty_comm')) ? $this->input->post('franchise_royalty_comm') : NULL;
			$roi = !empty($this->input->post('franchise_roi')) ? $this->input->post('franchise_roi') : NULL;
			$payback = !empty($this->input->post('franchise_payback')) ? $this->input->post('franchise_payback') : NULL;
			$property = !empty($this->input->post('franchise_property')) ? $this->input->post('franchise_property') : NULL;
			$floorArea = !empty($this->input->post('franchise_floor_area')) ? $this->input->post('franchise_floor_area') : NULL;
			$prefLocation = !empty($this->input->post('franchise_pref_location')) ? $this->input->post('franchise_pref_location') : NULL;
			$operatingManual = !empty($this->input->post('franchise_operating_manual')) ? $this->input->post('franchise_operating_manual') : NULL;
			$trainingLoc = !empty($this->input->post('franchise_training_loc')) ? $this->input->post('franchise_training_loc') : NULL;
			$termDuration = !empty($this->input->post('franchise_term_duration')) ? $this->input->post('franchise_term_duration') : NULL;
			$fieldAssistant = !empty($this->input->post('franchise_field_assistant')) ? $this->input->post('franchise_field_assistant') : NULL;
			$agreement = !empty($this->input->post('franchise_agreement')) ? $this->input->post('franchise_agreement') : NULL;
			$termRenew = !empty($this->input->post('franchise_term_renew')) ? $this->input->post('franchise_term_renew') : NULL;

			$adminDetails = $this->master_model->master_insert(
				"franchise_details",
				array(
					'name' => $businessName,
					'business_details' => $businessDetails,
					'investment_details' => $investmentDetails,
					'royalty_comm' => $royaltyCommision,
					'roi' => $roi,
					'payback' => $payback,
					'property' => $property,
					'floorarea' => $floorArea,
					'pref_loc' => $prefLocation,
					'operating_manual' => $operatingManual,
					'training_loc' => $trainingLoc,
					'term_duration' => $termDuration,
					'field_assistant' => $fieldAssistant,
					'agreement' => $agreement,
					'term_renew' => $termRenew,
					'is_deleted' => 'false'
				)
			);

			if (!$adminDetails) {
				$response = array(
					'status' => 'error',
					'message' => "Sorry, something went wrong on server, please try again."
				);
				echo json_encode($response);
				return;
			}

			$response = array(
				'status' => 'success',
				'message' => 'Details Added'
			);
			echo json_encode($response);
			return;
		}
	}

	public function queries()
	{
		$isAdminLoggedIn = $this->session->userdata('admin_logged_in');
		if (!(isset($isAdminLoggedIn) && $isAdminLoggedIn == 1)) {
			redirect("auth/");
		}

		$this->load->view('modules/queries.php');
	}

	public function clients()
	{
		$isAdminLoggedIn = $this->session->userdata('admin_logged_in');
		if (!(isset($isAdminLoggedIn) && $isAdminLoggedIn == 1)) {
			redirect("auth/");
		}

		$this->load->view('modules/clients.php');
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
