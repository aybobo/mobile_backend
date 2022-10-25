<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        if (!$this->ion_auth->logged_in())
        {
        redirect('admin/index');
        }
        $this->load->model('base_model');
    }

    //---------------------------

	public function index()
	{
        //events
        $allevents = $this->base_model->getFewEvents();
        $events = '';
        $num = 0;

        if ($allevents) {
            $events = $allevents['rows'];
            $num = $allevents['num'];
        }

        //projects
        $allprojects = $this->base_model->getFewProjects();
        $projects = '';
        $count = 0;

        if ($allprojects) {
            $projects = $allprojects['rows'];
            $count = $allprojects['num'];
        }
        $this->load->view('admin/inc/header');
		$this->load->view('admin/dashboard', ['events' => $events, 'num' => $num, 'projects' => $projects, 'count' => $count]);
        $this->load->view('admin/inc/footer');
	}

    /*--------------------------------
            EVENT SECTION
    -----------------------------------*/

    public function events()
    {
        $allevents = $this->base_model->getAllEvents();
        $events = '';
        $num = 0;

        if ($allevents) {
            $events = $allevents['rows'];
            $num = $allevents['num'];
        }

        $this->load->view('admin/inc/header');
        $this->load->view('admin/events_view', ['events' => $events, 'num' => $num]);
		$this->load->view('admin/inc/footer');
    }

    public function addevent()
    {
		$config['upload_path']          = './events/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 5000;
        $config['max_width']            = 1200;
        $config['max_height']           = 7680;
		$this->load->library('upload', $config);

        $this->form_validation->set_rules('eventname', 'Event name', 'trim|required');
        $this->form_validation->set_rules('aboutevent', 'Event description', 'trim|required');
        $this->form_validation->set_rules('venue', 'Event venue', 'trim|required');
        $this->form_validation->set_rules('location', 'Event location', 'required');
        $this->form_validation->set_rules('datetime', 'Event start date and time', 'required');
        $this->form_validation->set_rules('enddatetime', 'Event end date and time', 'required');

        if ($this->form_validation->run() === TRUE) {
            $data = $this->input->post();
			$data['filename'] = 'https://dalexintegrated.com/events/events/';

			if (!$this->upload->do_upload('flier')) {
				$this->session->set_flashdata('msg', 'Failed to upload: File too large or wrong filetype');
                return redirect('dashboard/events');
			}
			else {
				$upload_data = $this->upload->data();
                $data['filename'] .= $upload_data['file_name'];
			}

            $parts = explode(" ", $data['datetime']);
            $startDay = date("Y-m-d", strtotime($parts[0]));
            $startTime = $parts[1] . ' ' . $parts[2];
            $endDate = explode(" ", $data['enddatetime']);
            $end_date = date("Y-m-d", strtotime($endDate[0]));
            $endTime = $endDate[1] . ' ' . $endDate[2];
            if ($startDay > $end_date) {
                $this->session->set_flashdata('msg', 'Invalid duration: start date cannot be greater than end date');
                return redirect('dashboard/events');
            }

            if ($startDay === $end_date) {
                if ($startTime > $endTime) {
                    $this->session->set_flashdata('msg', 'Invalid duration: start date cannot be greater than end date');
                    return redirect('dashboard/events');
                }
            }

           $rowData = array('eventName' => $data['eventname'],
                            'eventDesc' => $data['aboutevent'],
                            'venue'    => $data['venue'],
                            'eventLocation'    => $data['location'],
                            'eventStartDate' => date('D, F j, Y',strtotime($startDay)),
                            'eventStartTime' => $startTime,
                            'eventEndDate' => date('D, F j, Y',strtotime($end_date)),
                            'eventEndTime' => $endTime,
                            'numberOfEventAttendees' => 0,
                            'flatPickrEndDate' => $endDate[0],
                            'eventFlier' => $data['filename'],
                            'createDate' => date('Y-m-d H:i:s'),
                            'eventDateForAdmin' => $parts[0],
                            'adminId'   => $this->session->userdata('user_id')
            );
			$newEvent = $this->base_model->addNewEvent($rowData);

            if ($newEvent) {
                $this->session->set_flashdata('success', 'Event added');
            }
            else {
                $this->session->set_flashdata('msg', 'Error saving to database');
            }
            return redirect('dashboard/events');
        }
        else {
            $allevents = $this->base_model->getAllEvents();
            $events = '';
            $num = 0;

            if ($allevents) {
                $events = $allevents['rows'];
                $num = $allevents['num'];
            }

            $this->load->view('admin/inc/header');
            $this->load->view('admin/inc/nav');
            $this->load->view('admin/events_view', ['events' => $events, 'num' => $num]);
            $this->load->view('admin/inc/footer');
        }
    }

    public function updateevent()
    {
		$config['upload_path']          = './events/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 5000;
        $config['max_width']            = 1200;
        $config['max_height']           = 7680;
		$this->load->library('upload', $config);

        $this->form_validation->set_rules('eventname', 'Event name', 'trim|required');
        $this->form_validation->set_rules('aboutevent', 'Event description', 'trim|required');
        $this->form_validation->set_rules('venue', 'Event venue', 'trim|required');
        $this->form_validation->set_rules('location', 'Event location', 'trim|required');
        $this->form_validation->set_rules('status', 'Event status', 'required');

        if ($this->form_validation->run() === TRUE) {
            $data = $this->input->post();
            $data['adminStartDate'] = '';

            if ($_POST['datetime'] == '') {
                $data['startDate'] = $this->input->post('oldStartDate');
                $data['adminStartDate'] = $this->input->post('oldStartDate');
                $data['startTime'] = $this->input->post('oldStartTime');
            }
            else {
                $parts = explode(" ", $data['datetime']);
                $data['startDate'] = $parts[0];
                $data['adminStartDate'] = $parts[0];
                $data['startTime'] = $parts[1] . ' ' . $parts[2];
            }

            if ($_POST['enddatetime'] == '') {
                $data['endDate'] = $this->input->post('oldEndDate');
                $data['endTime'] = $this->input->post('oldEndTime');
            }
            else {
                $endDate = explode(" ", $data['enddatetime']);
                $data['endDate'] = $endDate[0];
                $data['endTime'] = $endDate[1] . ' ' . $parts[2];
            }

            if ($data['startDate'] > $data['endDate']) {
                $this->session->set_flashdata('msg', 'Invalid duration: start day cannot be greater than start time');
                return redirect('dashboard/events');
            }

            if ($data['startDate'] === $data['endDate']) {
                if ($data['startTime'] > $data['endTime']) {
                    $this->session->set_flashdata('msg', 'Invalid duration: start time cannot be greater than end time for 1-day event');
                    return redirect('dashboard/events');
                }
            }

            $data['filename'] = '';

            if ($_FILES['flier']['size'] > 0) {
                if (!$this->upload->do_upload('flier')) {
                    $this->session->set_flashdata('msg', 'Failed to upload: File too large or wrong filetype');
                    return redirect('dashboard/events');
                }
                else {
                    $upload_data = $this->upload->data();
                    $data['filename'] = 'https://dalexintegrated.com/events/events/'.$upload_data['file_name'];
                }
            }

            $data['startDate'] = date('D, F j, Y',strtotime($data['startDate']));
            $data['endDate'] = date('D, F j, Y',strtotime($data['endDate']));
            $data['eventDateForAdmin'] = $data['adminStartDate'];
            $data['modifiedBy'] = $this->session->userdata('full_name');
            $data['dateModified'] = date('Y-m-d H:i:s');
            $update = $this->base_model->updateEvent($data);

            if ($update) {
                $this->session->set_flashdata('success', 'Event update successful');
            }
            else {
                $this->session->set_flashdata('msg', 'Unable to update event');
            }
            return redirect('dashboard/events');
        }
        $this->session->set_flashdata('msg', 'Ensure that all fields are properly filled.');
        return redirect('dashboard/events');
    }

    public function listOfEventAttendees($eventId)
    {
        $eventId = $this->uri->segment(3);
        $attendees = $this->base_model->fetchEventAttendees($eventId);
        $eventName = $this->base_model->getEventName($eventId);

        if ($attendees && $eventName) {
            $rows = $attendees['rows'];

            $this->load->view('admin/inc/header');
            $this->load->view('admin/listattendees_view', ['rows' => $rows, 'eventName' => $eventName]);
            $this->load->view('admin/inc/footer');
        }
        else {
            $this->session->set_flashdata('msg', 'Server unavailable. Please try again');
            return redirect('dashboard/events');
        }

    }

    /*------------------------------------------
                END EVENT SECTION
    ---------------------------------------------*/

    public function promotions()
    {
        $this->load->view('admin/inc/header');
		$this->load->view('admin/inc/nav');
        $this->load->view('admin/promotions_view');
		$this->load->view('admin/inc/footer');
    }

    //-----------------------------------

    public function winnings()
    {
        $this->load->view('admin/inc/header');
		$this->load->view('admin/inc/nav');
        $this->load->view('admin/winnings_view');
		$this->load->view('admin/inc/footer');
    }

    //--------------------------------------

    public function adminusers()
    {
        if ($this->session->userdata('role') == 'Superadmin') {
            $allUsers = $this->base_model->getAllUsers();
            $users = '';
            $num = 0;

            if ($allUsers) {
                $users = $allUsers['rows'];
                $num = $allUsers['num'];
            }
            $this->load->view('admin/inc/header');
            $this->load->view('admin/adminusers_view', ['users' => $users, 'num' => $num]);
            $this->load->view('admin/inc/footer');
        }
        else {
            $this->session->set_flashdata('msg', 'Access denied');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function updateuser()
    {
        $this->form_validation->set_rules('firstname', 'First name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Last name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email address', 'trim|required|valid_email');

        if ($this->form_validation->run() === TRUE) {
            $data = $this->input->post();
            
            $data['newdob'] = ($data['dob'] == '') ? $data['olddob'] : $data['dob'];
            $today = date('Y-m-d');

            if ($data['newdob'] > $today) {
                $this->session->set_flashdata('msg', 'Invalid date of birth');
                return redirect('dashboard/adminusers');
            }
            else {
                $diff = abs(strtotime(date('Y-m-d')) - strtotime($data['newdob']));
                $age = (int)floor($diff / (365*60*60*24));
                if ($age < 18) {
                    $this->session->set_flashdata('msg', 'Too young to register');
                    return redirect('dashboard/adminusers');
                }
                else {
                    $user = $this->base_model->updateUserDetails($data);

                    if ($user) {
                        $this->session->set_flashdata('success', 'User update successful');
                        return redirect('dashboard/adminusers');
                    }
                    else {
                        $this->session->set_flashdata('msg', 'Unable to update user details. Server unreachable');
                        return redirect('dashboard/adminusers');
                    }
                }
            }
        }
        else {
            $this->session->set_flashdata('msg', 'Kindly ensure that all fields are properly filled');
            return redirect('dashboard/adminusers');
        }
    }

    /*---------------------------------------
        NEWS SECTION
    -----------------------------------------*/

    public function newsitem()
    {
        $allNews = $this->base_model->getAllNews();
        $news = '';
        $num = 0;

        if ($allNews) {
            $news = $allNews['rows'];
            $num = $allNews['num'];
        }

        $this->load->view('admin/inc/header');
        $this->load->view('admin/newsitem_view', ['news' => $news, 'num' => $num]);
		$this->load->view('admin/inc/footer');
    }

    public function addNews()
    {
        $config['upload_path']          = './news/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 5000;
        $config['max_width']            = 1200;
        $config['max_height']           = 7680;
		$this->load->library('upload', $config);

        $this->form_validation->set_rules('title', 'News title', 'trim|required');
        $this->form_validation->set_rules('info', 'News article', 'trim|required');

        if ($this->form_validation->run() === TRUE) {
            $data = $this->input->post();
			$data['filename'] = 'https://dalexintegrated.com/events/news/';

			if (!$this->upload->do_upload('banner')) {
				$this->session->set_flashdata('msg', 'Failed to upload: File too large or wrong filetype');
                return redirect('dashboard/newsitem');
			}
			else {
				$upload_data = $this->upload->data();
                $data['filename'] .= $upload_data['file_name'];
			}

            $rowData = array(
                'title' => $data['title'],
                'information' => $data['info'],
                'newsImage' => $data['filename'],
                'entryDate' => date('F j, Y',strtotime(date('Y-m-d'))),
                'adminId'  => $this->session->userdata('user_id'),
                'createDate' => date('Y-m-d H:i:s')
            );

            $newsEntry = $this->base_model->addNewsArticle($rowData);

            if ($newsEntry) {
                $this->session->set_flashdata('success', 'News article added');
                return redirect('dashboard/newsitem');
            }
            else {
                $this->session->set_flashdata('msg', 'Error saving to database');
                return redirect('dashboard/newsitem');
            }
        }
        else {
            $allNews = $this->base_model->getAllNews();
            $news = '';
            $num = 0;

            if ($allNews) {
                $news = $allNews['rows'];
                $num = $allNews['num'];
            }
            $this->load->view('admin/inc/header');
            $this->load->view('admin/newsitem_view', ['news' => $news, 'num' => $num]);
            $this->load->view('admin/inc/footer');
        }
    }

    public function updatenews()
    {
        $data = $this->input->post();
        $config['upload_path']          = './news/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 5000;
        $config['max_width']            = 1200;
        $config['max_height']           = 7680;
		$this->load->library('upload', $config);

        $this->form_validation->set_rules('title1', 'News title', 'trim|required');
        $this->form_validation->set_rules('info1', 'News article', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() === TRUE) {
            $data = $this->input->post();
            $data['filename'] = '';

            if ($_FILES['flier']['size'] > 0) {
                if (!$this->upload->do_upload('flier')) {
                    $this->session->set_flashdata('msg', 'Failed to upload: File too large or wrong filetype');
                    return redirect('dashboard/newsitem');
                }
                else {
                    $upload_data = $this->upload->data();
                    $data['filename'] = 'https://dalexintegrated.com/events/news/'.$upload_data['file_name'];
                }
            }
            $data['entryDate'] = date('F j, Y',strtotime(date('Y-m-d')));
            $data['modifiedBy'] = $this->session->userdata('full_name');
            $data['dateModified'] = date('Y-m-d H:i:s');

            $update = $this->base_model->updateNews($data);

            if ($update) {
                $this->session->set_flashdata('success', 'News article update successful');
            }
            else {
                $this->session->set_flashdata('msg', 'Unable to update news article');
            }
            return redirect('dashboard/newsitem');
        }
        else {
            $this->session->set_flashdata('msg', 'Kindly ensure that all fields are properly filled');
            return redirect('dashboard/newsitem');
        }
    }

    public function deleteNews($id)
	{
		$delNews = $this->base_model->delNewsItem($id);

		if ($delNews) {
			$this->session->set_flashdata('success', 'News item deleted');
			return redirect('dashboard/newsitem');
		}
		$this->session->set_flashdata('msg', 'Delete failed');
		return redirect('dashboard/newsitem');
	}

    /*--------------------------------------
            END NEWS SECTION
    ----------------------------------------*/

    /*--------------------------------------
    *       PROJECT SECTION
    -------------------------------------*/

    public function projects()
    {
        $allProjects = $this->base_model->getAllProjects();
        $projects = '';
        $num = 0;
        if ($allProjects) {
            $projects = $allProjects['rows'];
            $num = $allProjects['num'];
        }
        $this->load->view('admin/inc/header');
        $this->load->view('admin/projects_view', ['projects' => $projects, 'num' => $num]);
		$this->load->view('admin/inc/footer');
    }

    public function addproject()
    {
        $config['upload_path']          = './projects/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 5000;
        $config['max_width']            = 1200;
        $config['max_height']           = 7680;
		$this->load->library('upload', $config);

        $this->form_validation->set_rules('title', 'Project title', 'trim|required');
        $this->form_validation->set_rules('projectdesc', 'Project description', 'trim|required');
        $this->form_validation->set_rules('startdate', 'Project start date', 'required');
        $this->form_validation->set_rules('enddate', 'Project end date', 'required');
        $this->form_validation->set_rules('venue', 'Project venue', 'required');
        $this->form_validation->set_rules('location', 'Project location', 'required');

        if ($this->form_validation->run() === TRUE) {
            $data = $this->input->post();
			$data['filename'] = 'https://dalexintegrated.com/events/projects/';

			if (!$this->upload->do_upload('banner')) {
				$this->session->set_flashdata('msg', 'Failed to upload: File too large or wrong filetype');
                return redirect('dashboard/projects');
			}
			else {
				$upload_data = $this->upload->data();
                $data['filename'] .= $upload_data['file_name'];
			}

            if ($data['startdate'] > $data['enddate']) {
                $this->session->set_flashdata('msg', 'Invalid date entry');
                return redirect('dashboard/projects');
            }

            $rowData = array('projectTitle' => $data['title'],
                             'projectDescription' => $data['projectdesc'],
                             'projectImage' => $data['filename'],
                             'projectStartDate' => $data['startdate'],
                             'projectEndDate' => $data['enddate'],
                             'projectVenue' => $data['venue'],
                             'projectLocation' => $data['location'],
                             'adminId' => $this->session->userdata('user_id'),
                             'entryDate' => date('Y-m-d H:i:s')
            );

			$newProject = $this->base_model->addNewProject($rowData);

            if ($newProject) {
                $this->session->set_flashdata('success', 'Project added');
            }
            else {
                $this->session->set_flashdata('msg', 'Error saving to database');
            }
            return redirect('dashboard/projects');
        }
        else {
            $allProjects = $this->base_model->getAllProjects();
            $projects = '';
            $num = 0;

            if ($allProjects) {
                $projects = $allProjects['rows'];
                $num = $allProjects['num'];
            }

            $this->load->view('admin/inc/header');
            $this->load->view('admin/inc/nav');
            $this->load->view('admin/projects_view', ['projects' => $projects, 'num' => $num]);
            $this->load->view('admin/inc/footer');
        }
    }

    public function updateproject()
    {
		$config['upload_path']          = './projects/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 5000;
        $config['max_width']            = 1200;
        $config['max_height']           = 7680;
		$this->load->library('upload', $config);

        $this->form_validation->set_rules('title1', 'Project title', 'trim|required');
        $this->form_validation->set_rules('projectdesc1', 'Project description', 'trim|required');
        $this->form_validation->set_rules('status1', 'Project status', 'required');
        $this->form_validation->set_rules('venue1', 'Project venue', 'required');
        $this->form_validation->set_rules('location1', 'Project location', 'required');

        if ($this->form_validation->run() === TRUE) {
            $data = $this->input->post();

            if ($_POST['startdate1'] == '') {
                $data['startdate1'] = $this->input->post('oldStartDate');
            }
            if ($_POST['enddate1'] == '') {
                $data['enddate1'] = $this->input->post('oldEndDate');
            }
            
            if ($data['startdate1'] > $data['enddate1']) {
                $this->session->set_flashdata('msg', 'Invalid date entry');
                return redirect('dashboard/projects');
            }
            $data['filename'] = '';

            if ($_FILES['flier1']['size'] > 0) {
                if (!$this->upload->do_upload('flier1')) {
                    $this->session->set_flashdata('msg', 'Failed to upload: File too large or wrong filetype');
                    return redirect('dashboard/projects');
                }
                else {
                    $upload_data = $this->upload->data();
                    $data['filename'] = 'https://dalexintegrated.com/events/projects/'.$upload_data['file_name'];
                }
            }
            $data['modifiedBy'] = $this->session->userdata('full_name');
            $data['dateModified'] = date('Y-m-d H:i:s');
            $update = $this->base_model->updateProject($data);

            if ($update) {
                $this->session->set_flashdata('success', 'Project update successful');
            }
            else {
                $this->session->set_flashdata('msg', 'Unable to update project');
            }
            return redirect('dashboard/projects');
        }
        else {

            $this->session->set_flashdata('msg', 'Kindly ensure that all fields are properly filled');
            return redirect('dashboard/projects');
        }
    }

    /*--------------------------------------
    *      END  PROJECT SECTION
    -------------------------------------*/

}
