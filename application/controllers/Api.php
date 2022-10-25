<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('api_model');
        $this->load->library('ion_auth');
        $this->load->model('base_model');
    }

    /*=======================================================
        EVENTS API SECTION
    ========================================================
    */

    public function getAllEvents()
    {
        $allevents = $this->api_model->fetchAllEvent();

        $eventfiles = $this->api_model->getEventFiles();
        $output['allevents'] = $allevents;
        $output['eventfiles'] = $eventfiles;
        echo json_encode($output);
    }

    public function attendEvent()
    {
        $body = file_get_contents("php://input");
        $object = json_decode($body, true);	
        log_message('error', "logging object");
        log_message('error', var_export($object,true));
        log_message('error', var_export($body,true));
            
        switch (json_last_error()) {
                case JSON_ERROR_NONE:
                log_message('error',' - No errors');
            break;
            case JSON_ERROR_DEPTH:
                log_message('error',' - Maximum stack depth exceeded');
            break;
            case JSON_ERROR_STATE_MISMATCH:
                log_message('error',  ' - Underflow or the modes mismatch');
            break;
            case JSON_ERROR_CTRL_CHAR:
                log_message('error', ' - Unexpected control character found');
            break;
            case JSON_ERROR_SYNTAX:
                log_message('error', ' - Syntax error, malformed JSON');
            break;
            case JSON_ERROR_UTF8:
                log_message('error', ' - Malformed UTF-8 characters, possibly incorrectly encoded');
            break;
            default:
                log_message('error', ' - Unknown error');
            break;
        }


        $data['userId'] = $object['userId'];
        $data['eventId'] = $object['eventId'];
        $data['registerDate'] = date('Y-m-d H:i:s');

        $checkUser = $this->api_model->checkUserInEvent($data);

        if ($checkUser) {
            $output['status'] = 400;
            $output['message'] = 'Already registered';
        }
        else {
            $register = $this->api_model->attendEvent($data);
            if ($register) {
                $message = 'Hi ' . $register['fullName'] . ', <br>';
                $message .= 'You have successfully registered for ' . $register['eventName'];

                $this->email->set_newline("\r\n");
                $this->email->set_crlf( "\r\n" );
                $this->email->from('ayo.arish@dalexintegrated.com');
                $this->email->subject('Event registration');
                $this->email->to($register['email']);
                $this->email->message($message);
                $this->email->validate = true;
                if ($this->email->send()) {
                    $output['status'] = 200;
                    $output['message'] = 'Registration successful';
                }
                else {
                    $output['status'] = 201;
                    $output['message'] = 'Registration successful, unable to deliver email';
                }
            }
            else {
                $output['status'] = 401;
                $output['message'] = 'Failure to register: server unavailable';
            }
        }
        log_message('error', 'Before sending');
        log_message('error', var_export($output,true));
        echo json_encode($output);
    }

    public function getSingleEvent($id)
    {
        $singleEvent = $this->api_model->fetchSingleEvent($id);
        $eventfiles = $this->api_model->getSingleEventFiles($id);
        $output['singleEvent'] = $singleEvent;
        $output['eventfiles'] = $eventfiles;
        echo json_encode($output);
    }

     /*=======================================================
       END EVENTS API SECTION
    ========================================================
    */

    /*=======================================================
        NEWS API SECTION
    ========================================================
    */

    public function getAllNews()
    {
        $allnews = $this->api_model->fetchAllNews();
        $newsfiles = $this->api_model->getAllNewsFiles();
        $output['allnews'] = $allnews;
        $output['newsfiles'] = $newsfiles;
        echo json_encode($output);
    }

    public function getSingleNews($id)
    {
        $singleNews = $this->api_model->fetchSingleNews($id);
        $newsfiles = $this->api_model->fetchSingleNewsFiles($id);
        $output['singleNews'] = $singleNews;
        $output['newsfiles'] = $newsfiles;
        echo json_encode($output);
    }


     /*=======================================================
            END NEWS API SECTION
    ========================================================
    */

     /*=======================================================
        PROJECTS API SECTION
    ========================================================
    */

    public function getSingleProject($id)
    {
        $singleproject = $this->api_model->fetchSingleProject($id);
        $projectfiles = $this->api_model->fetchSingleProjectFiles($id);
        $output['singleproject'] = $singleproject;
        $output['projectfiles'] = $projectfiles;
        echo json_encode($output);
    }

    public function getCompletedProjects()
    {
        $completed = $this->api_model->fetchCompletedProjects();
        $projectfiles = $this->api_model->fetchCompletedFiles();
        $output['completed'] = $completed;
        $output['projectfiles'] = $projectfiles;
        echo json_encode($output);
    }

    public function getPendingProjects()
    {
        $pending = $this->api_model->fetchPendingProjects();
        $projectfiles = $this->api_model->fetchPendingProjectFiles();
        $output['pending'] = $pending;
        $output['projectfiles'] = $projectfiles;
        echo json_encode($output);
    }

    public function getInProgressProjects()
    {
        $progress = $this->api_model->fetchInProgressProjects();
        $projectfiles = $this->api_model->fetchInProgressProjectFiles();
        $output['progress'] = $progress;
        $output['projectfiles'] = $projectfiles;
        echo json_encode($output);
    }


     /*=======================================================
            END PROJECTS API SECTION
    ========================================================
    */

    /*=======================================================
        WINNERS API SECTION
    ========================================================
    */

    public function getAllWinners()
    {
        $allwinners = $this->api_model->fetchAllWinners();
        echo json_encode($allwinners);
    }

     /*=======================================================
            END WINNERS API SECTION
    ========================================================
    */

     /*=======================================================
        PROMOTIONS API SECTION
    ========================================================
    */

    public function getAllActivePromotions()
    {
        $promotions = $this->api_model->fetchAllOngoingPromotions();
        echo json_encode($promotions);
    }

     /*=======================================================
            END PROMOTIONS API SECTION
    ========================================================
    */

    /*=======================================================
        USERS API SECTION
    ========================================================
    */

    public function allRegisteredUsers()
    {
        $users = $this->api_model->getRegisteredUsers();
        echo json_encode($users);
    }

    public function login()
	{
        $body = file_get_contents("php://input");
        $object = json_decode($body, true);	
        log_message('error', "logging object");
        log_message('error', var_export($object,true));
        log_message('error', var_export($body,true));
            
        switch (json_last_error()) {
                case JSON_ERROR_NONE:
                log_message('error',' - No errors');
            break;
            case JSON_ERROR_DEPTH:
                log_message('error',' - Maximum stack depth exceeded');
            break;
            case JSON_ERROR_STATE_MISMATCH:
                log_message('error',  ' - Underflow or the modes mismatch');
            break;
            case JSON_ERROR_CTRL_CHAR:
                log_message('error', ' - Unexpected control character found');
            break;
            case JSON_ERROR_SYNTAX:
                log_message('error', ' - Syntax error, malformed JSON');
            break;
            case JSON_ERROR_UTF8:
                log_message('error', ' - Malformed UTF-8 characters, possibly incorrectly encoded');
            break;
            default:
                log_message('error', ' - Unknown error');
            break;
        }

        $identity = $object["identity"];
        $password = $object["password"];
        $remember = 1;

        $data = array('status' => 404,
					'message' => 'Kindly provide your email and password',
                    'userId' => 0
				);
		if ($identity != '' && $password != '') {
            if (filter_var($identity, FILTER_VALIDATE_EMAIL)) {
                $remember = (bool) $remember;
                if ($this->ion_auth->login($identity, $password)) {
                    if ($this->session->userdata('active') == 0) {
                        $data['status'] = 407;
				        $data['message'] = 'Account deactivated. Contact admin';
                        $data['userId'] = 0;
                    }
                    else {
                        $userId = $this->base_model->getUserId($identity);
                        if ($userId) {
                            $data['status'] = 200;
				            $data['message'] = 'Login Successful';
                            $data['userId'] = $userId;
                        }
                        else {
                            $data['status'] = 201;
				            $data['message'] = 'An error occured. Please try again';
                            $data['userId'] = 0;
                        }
                    }
                }
                else {
                    $data['status'] = 406;
				    $data['message'] = 'Login Failed';
                    $data['userId'] = 0;
                }
            }
            else {
                $data['status'] = 405;
				$data['message'] = 'Invalid email';
                $data['userId'] = 0;
            }
        }
        log_message('error', 'Before Sending out');
        log_message('error', var_export($data,true));
        header('Content-type: application/json');
        echo json_encode($data);
	}

	public function create()
	{
        $body = file_get_contents("php://input");
        $object = json_decode($body, true);	
         log_message('error', "logging object");
         log_message('error', var_export($object,true));
		 log_message('error', var_export($body,true));
		
    switch (json_last_error()) {
			   case JSON_ERROR_NONE:
             log_message('error',' - No errors');
        break;
        case JSON_ERROR_DEPTH:
             log_message('error',' - Maximum stack depth exceeded');
        break;
        case JSON_ERROR_STATE_MISMATCH:
             log_message('error',  ' - Underflow or the modes mismatch');
        break;
        case JSON_ERROR_CTRL_CHAR:
             log_message('error', ' - Unexpected control character found');
        break;
        case JSON_ERROR_SYNTAX:
             log_message('error', ' - Syntax error, malformed JSON');
        break;
        case JSON_ERROR_UTF8:
             log_message('error', ' - Malformed UTF-8 characters, possibly incorrectly encoded');
        break;
        default:
             log_message('error', ' - Unknown error');
        break;
    
	}
		
        $first_name = ucfirst(strtolower(trim($object["first_name"])));
        $last_name = ucfirst(strtolower(trim($object["last_name"])));
        $email = strtolower(trim($object["email"]));
        $password = trim($object["password"]);
        $password_confirm = trim($object["password_confirm"]);
        $location = ucfirst(strtolower($object["location"]));
        $dob = $object["dob"];

		$data = array('status' => 404,
					'message' => 'Kindly ensure that all fields are properly filled'
				);

        if ($first_name != '' && $last_name != '' && $email != '' && $password != '' 
            && $password_confirm != '' && $location != '' && $dob != '') {
            $diff = abs(strtotime(date('Y-m-d')) - strtotime($dob));
            $age = (int)floor($diff / (365*60*60*24));
            if ($age >= 18) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $checkEmail = $this->base_model->checkIfEmailExists($email);
                    if ($checkEmail) {
                        $data['status'] = 407;
                        $data['message'] = 'User with email exists';
                    }
                    else {
                        if ($password === $password_confirm) {
                            $username = $first_name;
                            $email = $email;
                            $password = $password;
                            $group_ids = [1, 2];
                            $createdBy = $first_name . ' ' . $last_name;
                            $dateCreated = date('Y-m-d H:i:s');
                            $hashEmail = hash('sha256', $email . KEY);

                            $additional_data = array(
                                'first_name' => $first_name,
                                'last_name' => $last_name,
                                'location' => $location,
                                'dob' => $dob,
                                'dateCreated' => $dateCreated,
                                'role' => 'General',
                                'status' => 'Active',
                                'activationToken' => $hashEmail,
                                'createdBy' => $createdBy
                                );
                            $register = $this->ion_auth->register($username, $password, $email, $additional_data, $group_ids);
                            if ($register) {
                                
                                $data['status'] = 200;
                                $data['message'] = 'Registration successful. Kindly log into your email to activate your account';
                            }
                            else {
                                $data['status'] = 402;
                                $data['message'] = 'Registration failed: server unavailable';
                            }
                        }
                        else {
                            $data['status'] = 401;
                            $data['message'] = 'Password mismatch';
                        }
                    }
                }
                else {
                    $data['status'] = 406;
                    $data['message'] = 'Invalid email';
                }
            }
            else {
                $data['status'] = 405;
                $data['message'] = 'Sorry you are too young to register';
            }
        }
        log_message('error', 'Before Sending out');
        log_message('error', var_export($data,true));
        header('Content-type: application/json');
        echo json_encode($data);
	}

    public function activateSuccess()
    {
        $data = array('status' => 200, 'message' => 'Account successfully activated');
        log_message('error', 'Before Sending out after verification');
        log_message('error', var_export($data,true));
        header('Content-type: application/json');
        echo json_encode($data);
    }

     /*=======================================================
            END USERS API SECTION
    ========================================================
    */
}
