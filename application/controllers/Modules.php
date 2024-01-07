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

		$franchiseDetails = $this->master_model->master_get(
			"franchise_details",
			array(
				'is_deleted' => 'false'
			),
			"*",
			false,
			2,
			false,
			false,
			false,
			false,
			false,
			false,
			false,
			'franchise_id',
			'desc'
		);

		$this->load->view('modules/franchise.php', array('franchise' => $franchiseDetails));
	}

	public function get_all_franchise()
	{
		Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
		Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
		Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed

		$requestHost = $this->input->server('HTTP_HOST');
		$allowedHost = 'backend.maharashtraudyog.com';

		if ($requestHost != $allowedHost) {
			$response = array(
				'status' => 'error',
				'message' => "Invalid Request"
			);
			echo json_encode($response);
			return;
		}

		$search = isset($_GET['search-franchise']) ? $_GET['search-franchise'] : NULL;

		$sqlWhere = "is_deleted = 'false'";

		if($search != NULL){
			$sqlWhere .= " AND (`name` LIKE '%$search%') AND (`name` LIKE '%$franchise_details%')";
		}

		$franchiseDetails = $this->master_model->master_get(
			"franchise_details",
			$sqlWhere,
			"*",
			false,
			2,
			false,
			false,
			false,
			false,
			false,
			false,
			false,
			'franchise_id',
			'desc'
		);

		if (!$franchiseDetails) {
			$response = array(
				'status' => 'error',
				'message' => "Sorry, something went wrong on server, please try again."
			);
			echo json_encode($response);
			return;
		}

		foreach ($franchiseDetails as $key => $value) {
			$franchiseDetails[$key]['media'] = array();

			$franchiseMediaDetails = $this->master_model->master_get(
				"franchise_media",
				array(
					'franchise_id' => $value['franchise_id'],
					'is_deleted' => 'false'
				),
				"*",
				false,
				2
			);

			if ($franchiseMediaDetails)
				$franchiseDetails[$key]['media'] = $franchiseMediaDetails;
		}

		$response = array(
			'status' => 'success',
			'message' => "Details Fetched",
			'franchise' => $franchiseDetails
		);
		echo json_encode($response);
		return;
	}

	public function get_franchise_by_id()
	{
		Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
		Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
		Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed

		// $requestHost = $this->input->server('HTTP_HOST');
		// $allowedHost = 'backend.maharashtraudyog.com';

		// if ($requestHost != $allowedHost) {
		// 	$response = array(
		// 		'status' => 'error',
		// 		'message' => "Invalid Request"
		// 	);
		// 	echo json_encode($response);
		// 	return;
		// }

		if (!isset($_GET['franchise_id'])) {
			$response = array(
				'status' => 'error',
				'message' => "Invalid Request [Get]"
			);
			echo json_encode($response);
			return;
		}

		$franchiseDetails = $this->master_model->master_get(
			"franchise_details",
			array(
				'franchise_id' => $_GET['franchise_id'],
				'is_deleted' => 'false'
			),
			"*",
			false,
			2,
			false,
			false,
			false,
			false,
			false,
			false,
			false,
			'franchise_id',
			'desc'
		);

		if (!$franchiseDetails) {
			$response = array(
				'status' => 'error',
				'message' => "Sorry, something went wrong on server, please try again."
			);
			echo json_encode($response);
			return;
		}

		foreach ($franchiseDetails as $key => $value) {
			$franchiseDetails[$key]['media'] = array();

			$franchiseMediaDetails = $this->master_model->master_get(
				"franchise_media",
				array(
					'franchise_id' => $value['franchise_id'],
					'is_deleted' => 'false'
				),
				"*",
				false,
				2
			);

			if ($franchiseMediaDetails)
				$franchiseDetails[$key]['media'] = $franchiseMediaDetails;
		}

		$response = array(
			'status' => 'success',
			'message' => "Details Fetched",
			'franchise' => $franchiseDetails
		);
		echo json_encode($response);
		return;
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
			$franchise_logo = "";
			$franchise_gallery_images = array();
			$franchise_gallery_videos = array();

			if (isset($_FILES['franchise_logo']) && $_FILES['franchise_logo']['error'] == 0) {
				$uploadPath = UPLOAD_DIR . "/franchise/logos/";

				if (!is_dir($uploadPath)) {
					mkdir($uploadPath, 0700, true);
				}

				$newFilename = $this->get_random_hash() . '.' . pathinfo($_FILES['franchise_logo']['name'], PATHINFO_EXTENSION);
				move_uploaded_file($_FILES['franchise_logo']['tmp_name'], $uploadPath . $newFilename);
				$franchise_logo = $newFilename;
			}

			if (!empty($_POST['franchise_image_gallery_repeat'])) {
				foreach ($_POST['franchise_image_gallery_repeat'] as $key => $value) {
					array_push($franchise_gallery_images, array('hash_name' => $value['franchise_image_gallery']));
				}
			}

			if (!empty($_POST['franchise_video_gallery_repeat'])) {
				foreach ($_POST['franchise_video_gallery_repeat'] as $key => $value) {
					array_push($franchise_gallery_videos, array('video_url' => $value['franchise_gallery_video']));
				}
			}

			$businessName = !empty($this->input->post('franchise_name')) ? $this->input->post('franchise_name') : NULL;
			$details = !empty($this->input->post('franchise_details')) ? $this->input->post('franchise_details') : NULL;
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

			$franchiseDetails = $this->master_model->master_insert(
				"franchise_details",
				array(
					'name' => $businessName,
					'franchise_details' => $details,
					'logo' => $franchise_logo,
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

			if (!$franchiseDetails) {
				$response = array(
					'status' => 'error',
					'message' => "Sorry, something went wrong on server, please try again."
				);
				echo json_encode($response);
				return;
			}

			foreach ($franchise_gallery_images as $key => $value) {
				$this->master_model->master_insert(
					"franchise_media",
					array(
						'franchise_id' => $franchiseDetails,
						'hash_name' => $value['hash_name'],
						'type' => 'image',
					)
				);
			}

			foreach ($franchise_gallery_videos as $key => $value) {
				$this->master_model->master_insert(
					"franchise_media",
					array(
						'franchise_id' => $franchiseDetails,
						'video_url' => $value['video_url'],
						'type' => 'video',
					)
				);
			}

			$response = array(
				'status' => 'success',
				'message' => 'Details Added'
			);
			echo json_encode($response);
			return;
		}
	}

	public function submit_application()
	{
		Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
		Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
		Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed

		$franchiseDetails = $this->master_model->master_insert(
			"franchise_application",
			array(
				'franchise_id' => $_POST['franchise_id'],
				'name' => $_POST['name'],
				'dob' => $_POST['dob'],
				'contact' => $_POST['contact'],
				'whatsapp' => $_POST['whatsapp'],
				'cast' => $_POST['cast'],
				'maritial' => $_POST['maritial'],
				'district' => $_POST['district'],
				'job' => $_POST['job'],
				'comp_name' => $_POST['comp_name'],
				'job_desc' => $_POST['job_desc'],
				'intrest' => $_POST['intrest'],
				'address' => $_POST['address'],
				'acknowledgement' => $_POST['acknowledgement'],
				'is_deleted' => 'false'
			)
		);

		if (!$franchiseDetails) {
			$response = array(
				'status' => 'error',
				'message' => "Sorry, something went wrong on server, please try again."
			);
			echo json_encode($response);
			return;
		}

		$response = array(
			'status' => 'success',
			'message' => "Application Submitted",
		);
		echo json_encode($response);
		return;
	}

	public function get_franchise()
	{
		$isAdminLoggedIn = $this->session->userdata('admin_logged_in');
		if (!(isset($isAdminLoggedIn) && $isAdminLoggedIn == 1)) {
			redirect("auth/");
		}

		$this->form_validation->set_rules('franchise_id', 'Franchise ID', 'trim|required');

		if ($this->form_validation->run() === FALSE) {
			$response = array(
				'status' => 'error',
				'message' => validation_errors()
			);
			echo json_encode($response);
			return;
		} else {

			$franchise_id = !empty($this->input->post('franchise_id')) ? $this->input->post('franchise_id') : NULL;

			$franchiseDetails = $this->master_model->master_get(
				"franchise_details",
				array(
					'franchise_id' => $franchise_id,
					'is_deleted' => 'false'
				),
				"*",
				false,
				0
			);

			$franchiseMediaDetails = $this->master_model->master_get(
				"franchise_media",
				array(
					'franchise_id' => $franchise_id,
					'is_deleted' => 'false'
				),
				"*",
				false,
				2
			);

			if (!$franchiseDetails) {
				$response = array(
					'status' => 'error',
					'message' => "Sorry, something went wrong on server, please try again."
				);
				echo json_encode($response);
				return;
			}

			$response = array(
				'status' => 'success',
				'message' => 'Details Fetched',
				'data' => array('franchise' => array_merge($franchiseDetails, array('media' => $franchiseMediaDetails)))
			);
			echo json_encode($response);
			return;
		}
	}

	public function update_franchise()
	{
		$isAdminLoggedIn = $this->session->userdata('admin_logged_in');
		if (!(isset($isAdminLoggedIn) && $isAdminLoggedIn == 1)) {
			redirect("auth/");
		}

		$this->form_validation->set_rules('franchise_id_update', 'Franchise ID', 'trim|required');
		$this->form_validation->set_rules('franchise_name', 'Franchise Name', 'trim|required');

		if ($this->form_validation->run() === FALSE) {
			$response = array(
				'status' => 'error',
				'message' => validation_errors()
			);
			echo json_encode($response);
			return;
		} else {
			$franchise_logo = "";
			$franchise_gallery_images = array();
			$franchise_gallery_videos = array();

			if (isset($_FILES['franchise_updated_logo']) && $_FILES['franchise_updated_logo']['error'] == 0) {
				$uploadPath = UPLOAD_DIR . "/franchise/logos/";

				if (!is_dir($uploadPath)) {
					mkdir($uploadPath, 0700, true);
				}

				$newFilename = $this->get_random_hash() . '.' . pathinfo($_FILES['franchise_updated_logo']['name'], PATHINFO_EXTENSION);
				move_uploaded_file($_FILES['franchise_updated_logo']['tmp_name'], $uploadPath . $newFilename);
				$franchise_logo = $newFilename;
			}

			/*
			if (!empty($_FILES['franchise_video_gallery_repeat'])) {
				foreach ($_FILES['franchise_video_gallery_repeat']['name'] as $index => $file) {
					if (isset($_FILES['franchise_video_gallery_repeat']['name'][$index]['franchise_gallery_video'])) {
						$fileName = $_FILES['franchise_video_gallery_repeat']['name'][$index]['franchise_gallery_video'];
						$fileError = $_FILES['franchise_video_gallery_repeat']['error'][$index]['franchise_gallery_video'];
						$fileTempName = $_FILES['franchise_video_gallery_repeat']['tmp_name'][$index]['franchise_gallery_video'];
						if ($fileError == 0) {
							$uploadPath = UPLOAD_DIR . "/franchise/videos/";

							if (!is_dir($uploadPath)) {
								mkdir($uploadPath, 0700, true);
							}

							$newFilename = $this->get_random_hash() . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
							move_uploaded_file($fileTempName, $uploadPath . $newFilename);
							array_push($franchise_gallery_videos, array('original_name' => $fileName, 'hash_name' => $newFilename));
						}
					}
				}
			}
			*/

			$franchise_id_update = !empty($this->input->post('franchise_id_update')) ? $this->input->post('franchise_id_update') : NULL;
			$businessName = !empty($this->input->post('franchise_name')) ? $this->input->post('franchise_name') : NULL;
			$details = !empty($this->input->post('franchise_details')) ? $this->input->post('franchise_details') : NULL;
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

			$arrayToUpdate = array(
				'name' => $businessName,
				'franchise_details' => $details,
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
			);

			$this->master_model->master_update(
				"franchise_media",
				array(
					'is_deleted' => 'true'
				),
				array(
					'franchise_id' => $franchise_id_update
				)
			);
			
			if (!empty($_POST['franchise_image_gallery_update_repeat'])) {
				foreach ($_POST['franchise_image_gallery_update_repeat'] as $index => $file) {
					if (isset($_POST['franchise_image_gallery_update_repeat'][$index]['franchise_image_gallery'])) {
						$fileName = $_POST['franchise_image_gallery_update_repeat'][$index]['franchise_image_gallery'];
						$this->master_model->master_insert(
							"franchise_media",
							array(
								'franchise_id' => $franchise_id_update,
								'original_name' => NULL,
								'hash_name' => $fileName,
								'type' => 'image',
							)
						);
					}
				}
			}

			if ($franchise_logo != "") {
				$arrayToUpdate['logo'] = $franchise_logo;
			}

			$franchiseDetails = $this->master_model->master_update(
				"franchise_details",
				$arrayToUpdate,
				array(
					'franchise_id' => $franchise_id_update
				)
			);

			if (!$franchiseDetails) {
				$response = array(
					'status' => 'error',
					'message' => "Sorry, something went wrong on server, please try again."
				);
				echo json_encode($response);
				return;
			}

			// foreach ($franchise_gallery_images as $key => $value) {
			// 	$this->master_model->master_insert(
			// 		"franchise_media",
			// 		array(
			// 			'franchise_id' => $franchiseDetails,
			// 			'original_name' => $value['original_name'],
			// 			'hash_name' => $value['hash_name'],
			// 			'type' => 'image',
			// 		)
			// 	);
			// }

			// foreach ($franchise_gallery_videos as $key => $value) {
			// 	$this->master_model->master_insert(
			// 		"franchise_media",
			// 		array(
			// 			'franchise_id' => $franchiseDetails,
			// 			'original_name' => $value['original_name'],
			// 			'hash_name' => $value['hash_name'],
			// 			'type' => 'video',
			// 		)
			// 	);
			// }

			$response = array(
				'status' => 'success',
				'message' => 'Details Updated'
			);
			echo json_encode($response);
			return;
		}
	}

	public function delete_franchise()
	{
		$isAdminLoggedIn = $this->session->userdata('admin_logged_in');
		if (!(isset($isAdminLoggedIn) && $isAdminLoggedIn == 1)) {
			redirect("auth/");
		}

		$this->form_validation->set_rules('franchise_id', 'Franchise ID', 'trim|required');

		if ($this->form_validation->run() === FALSE) {
			$response = array(
				'status' => 'error',
				'message' => validation_errors()
			);
			echo json_encode($response);
			return;
		} else {

			$franchise_id = !empty($this->input->post('franchise_id')) ? $this->input->post('franchise_id') : NULL;

			$deleteDetails = $this->master_model->master_update(
				"franchise_details",
				array(
					'is_deleted' => 'true'
				),
				array(
					'franchise_id' => $franchise_id
				)
			);

			$deleteMediaDetails = $this->master_model->master_update(
				"franchise_media",
				array(
					'is_deleted' => 'true'
				),
				array(
					'franchise_id' => $franchise_id
				)
			);

			if (!$deleteDetails || !$deleteMediaDetails) {
				$response = array(
					'status' => 'error',
					'message' => "Sorry, something went wrong on server, please try again."
				);
				echo json_encode($response);
				return;
			}

			$response = array(
				'status' => 'success',
				'message' => 'Details Deleted'
			);
			echo json_encode($response);
			return;
		}
	}

	public function upload_file()
	{
		$isAdminLoggedIn = $this->session->userdata('admin_logged_in');
		if (!(isset($isAdminLoggedIn) && $isAdminLoggedIn == 1)) {
			redirect("auth/");
		}

		$newFilename = "";

		if (isset($_FILES['uploaded_file']) && $_FILES['uploaded_file']['error'] == 0) {
			$uploadPath = UPLOAD_DIR . "/" . "master/";

			if (!is_dir($uploadPath)) {
				mkdir($uploadPath, 0700, true);
			}

			$newFilename = $this->get_random_hash() . '.' . pathinfo($_FILES['uploaded_file']['name'], PATHINFO_EXTENSION);
			move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $uploadPath . $newFilename);
		} else {
			$response = array(
				'status' => 'error',
				'message' => "Sorry, something went wrong on server, please try again."
			);
			echo json_encode($response);
			return;
		}

		$response = array(
			'status' => 'success',
			'message' => 'Details Updated',
			'file_name' => $newFilename,
			'file_url' => APP_ENV == "prod" ? CDN_URL . '/public/uploads/master/' . $newFilename : BASE_URL . '/public/uploads/master/' . $newFilename
		);
		echo json_encode($response);
		return;
	}

	public function queries()
	{
		$isAdminLoggedIn = $this->session->userdata('admin_logged_in');
		if (!(isset($isAdminLoggedIn) && $isAdminLoggedIn == 1)) {
			redirect("auth/");
		}

		$this->load->view('modules/queries.php');
	}

	public function applications()
	{
		$isAdminLoggedIn = $this->session->userdata('admin_logged_in');
		if (!(isset($isAdminLoggedIn) && $isAdminLoggedIn == 1)) {
			redirect("auth/");
		}

		$sqlJoin = array(
			'franchise_details fd' => 'fd.franchise_id = fa.franchise_id|left',
		);

		$sqlSelect = "fa.*, fd.name as franchiseName";

		$sqlWhere = array(
			'fd.is_deleted' => 'false',
			'fa.is_deleted' => 'false'
		);

		$applicationDetails = $this->master_model->master_pagination("franchise_application as fa", $sqlWhere, $sqlSelect, false, 2, $sqlJoin, false, false, false, false, false, "DESC", "fa.application_id");

		$this->load->view('modules/applications.php',  array('application' => $applicationDetails));
	}

	public function get_application()
	{
		$isAdminLoggedIn = $this->session->userdata('admin_logged_in');
		if (!(isset($isAdminLoggedIn) && $isAdminLoggedIn == 1)) {
			redirect("auth/");
		}

		$this->form_validation->set_rules('application_id', 'Application ID', 'trim|required');

		if ($this->form_validation->run() === FALSE) {
			$response = array(
				'status' => 'error',
				'message' => validation_errors()
			);
			echo json_encode($response);
			return;
		} else {

			$application_id = !empty($this->input->post('application_id')) ? $this->input->post('application_id') : NULL;

			$sqlJoin = array(
				'franchise_details fd' => 'fd.franchise_id = fa.franchise_id|left',
			);

			$sqlSelect = "fa.*, fd.name as franchiseName";

			$sqlWhere = array(
				'fa.application_id' => $application_id,
				'fd.is_deleted' => 'false',
				'fa.is_deleted' => 'false'
			);

			$applicationDetails = $this->master_model->master_pagination("franchise_application as fa", $sqlWhere, $sqlSelect, false, 0, $sqlJoin, false, false, false, false, false, "DESC", "fa.application_id");

			$response = array(
				'status' => 'success',
				'message' => 'Details Fetched',
				'data' => array('application' => $applicationDetails[0])
			);
			echo json_encode($response);
			return;
		}
	}

	public function delete_application()
	{
		$isAdminLoggedIn = $this->session->userdata('admin_logged_in');
		if (!(isset($isAdminLoggedIn) && $isAdminLoggedIn == 1)) {
			redirect("auth/");
		}

		$this->form_validation->set_rules('application_id', 'Application ID', 'trim|required');

		if ($this->form_validation->run() === FALSE) {
			$response = array(
				'status' => 'error',
				'message' => validation_errors()
			);
			echo json_encode($response);
			return;
		} else {

			$application_id = !empty($this->input->post('application_id')) ? $this->input->post('application_id') : NULL;

			$deleteDetails = $this->master_model->master_update(
				"franchise_application",
				array(
					'is_deleted' => 'true'
				),
				array(
					'application_id' => $application_id
				)
			);

			if (!$deleteDetails) {
				$response = array(
					'status' => 'error',
					'message' => "Sorry, something went wrong on server, please try again."
				);
				echo json_encode($response);
				return;
			}

			$response = array(
				'status' => 'success',
				'message' => 'Details Deleted'
			);
			echo json_encode($response);
			return;
		}
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

	private function get_random_hash()
	{
		return bin2hex(openssl_random_pseudo_bytes(8)) .  bin2hex(openssl_random_pseudo_bytes(8)) . bin2hex(openssl_random_pseudo_bytes(8));
	}
}