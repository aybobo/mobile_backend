<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_model extends Ion_auth_model {

	/*----------------------------------
			EVENT SECTION
	----------------------------------*/

	public function addNewEvent($rowData)
    {
        return $this->db->insert('events', $rowData);
    }

	public function getAllEvents()
	{
		$this->db->select('*');
		$this->db->from('events');
		$this->db->join('users', 'events.adminId = users.id');
		$this->db->order_by('events.eventStartDate','ASC');
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$record = $query->result();
			return array('rows' => $record, 'num' => count($record));
		}
	}

	public function getFewEvents()
	{
		$this->db->from('events');
		$this->db->join('users', 'events.adminId = users.id');
		$this->db->order_by('events.eventStartDate','ASC');
		$this->db->limit(5);
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$record = $query->result();
			return array('rows' => $record, 'num' => count($record));
		}
	}

	public function updateEventStatus($data)
	{
		$this->db->where('eventId =', $data['eventId']);
		return $this->db->update('events', ['eventStatus' => $data['status']]);
	}

	public function getEventWithId($eventId)
	{
		$this->db->where('eventId =', $eventId);
		$query = $this->db->get('events');
		return $query->row();
	}

	public function updateEvent($data)
	{
		$this->db->trans_begin();
		$this->db->where('eventId =', $data['id']);
		$this->db->update('events', ['eventName' => $data['eventname'],
									'eventDesc' => $data['aboutevent'],
									'venue' => $data['venue'],
									'eventLocation' => $data['location'],
									'eventStartDate' => $data['startDate'],
									'eventStartTime' => $data['startTime'],
									'eventEndDate' => $data['endDate'],
									'eventEndTime' => $data['endTime'],
									'eventDateForAdmin' => $data['eventDateForAdmin'],
									'lastModifiedBy' => $data['modifiedBy'],
									'dateModified' => $data['dateModified'],
									'eventStatus' => $data['status']]);

		if ($data['filename'] != '') {
			unlink("events/".$data['imageName']);
			$this->db->where('eventId =', $data['id']);
			$this->db->update('events', ['eventFlier' => $data['filename']]);
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		}
		else {
			$this->db->trans_commit();
            return TRUE;
		}
	}

	public function fetchEventAttendees($eventId)
	{
		$this->db->where('eventId =', $eventId);
		$this->db->order_by('registerDate', 'ASC');
		$query = $this->db->get('event_attendees');

		if($query->num_rows() > 0) {
			$record = $query->result();
			return array('rows' => $record, 'num' => count($record));
		}
	}

	public function getEventName($eventId)
	{
		$this->db->where('eventId =', $eventId);
		$query = $this->db->get('events');
        return $query->row()->eventName;
	}

	/*----------------------------------
			END EVENT SECTION
	----------------------------------*/
	/*----------------------------------
			NEWS SECTION
	----------------------------------*/

    public function addNewsArticle($rowData)
    {
        return $this->db->insert('newsarticles', $rowData);
    }

	public function getAllNews()
	{
		$this->db->select('*');
		$this->db->from('newsarticles');
		$this->db->join('users', 'newsarticles.adminId = users.id');
		$this->db->order_by('newsarticles.createDate','DESC');
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$record = $query->result();
			return array('rows' => $record, 'num' => count($record));
		}
	}

	public function updateNewsStatus($data)
	{
		$this->db->where('newsId =', $data['newsId']);
		return $this->db->update('newsarticles', ['newsStatus' => $data['status']]);
	}

	public function getNewstWithId($newsId)
	{
		$this->db->where('newsId =', $newsId);
		$query = $this->db->get('newsarticles');
		return $query->row();
	}

	public function updateNews($data)
	{
		$this->db->trans_begin();
		$this->db->where('newsId  =', $data['id']);
		$this->db->update('newsarticles', ['title' => $data['title1'],
											'information' => $data['info1'],
											'lastModifiedBy' => $data['modifiedBy'],
											'dateModified' => $data['dateModified'],
											'entryDate' => $data['entryDate'],
											'newsStatus' => $data['status']]);

		if ($data['filename'] != '') {
			unlink("news/".$data['imageName']);
			$this->db->where('newsId =', $data['id']);
			$this->db->update('newsarticles', ['newsImage' => $data['filename']]);
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		}
		else {
			$this->db->trans_commit();
            return TRUE;
		}
	}

	public function delNewsItem($id)
	{
		$this->db->trans_begin();
		$this->db->where('newsId =', $id);
		$query = $this->db->get('newsarticles');
		$imageUrl = $query->row()->newsImage;
		$imageName = explode("/", $imageUrl);

		unlink("news/".$imageName[5]);

		$this->db->where('newsId =', $id);
		$this->db->delete('newsarticles');

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		}
		else {
			$this->db->trans_commit();
            return  TRUE;
		}
	}

	/*----------------------------------
			END NEWS SECTION
	----------------------------------*/
	/*----------------------------------
			PROJECT SECTION
	----------------------------------*/

	public function addNewProject($rowData)
    {
        return $this->db->insert('projects', $rowData);
    }

	public function getAllProjects()
	{
		$this->db->select('*');
		$this->db->from('projects');
		$this->db->join('users', 'projects.adminId = users.id');
		$this->db->order_by('projects.projectStartDate','DESC');
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$record = $query->result();
			return array('rows' => $record, 'num' => count($record));
		}
	}

	public function getFewProjects()
	{
		$this->db->from('projects');
		$this->db->join('users', 'projects.adminId = users.id');
		$this->db->order_by('projects.projectStartDate','DESC');
		$this->db->limit(5);
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$record = $query->result();
			return array('rows' => $record, 'num' => count($record));
		}
	}

	public function updateProjectStatus($data)
	{
		$this->db->where('projectId =', $data['projectId']);
		return $this->db->update('projects', ['projectStatus' => $data['status']]);
	}

	public function getProjectWithId($projectId)
	{
		$this->db->where('projectId =', $projectId);
		$query = $this->db->get('projects');
		return $query->row();
	}

	public function updateProject($data)
	{
		$this->db->trans_begin();
		$this->db->where('projectId =', $data['id1']);
		$this->db->update('projects', ['projectTitle' => $data['title1'],
									'projectDescription' => $data['projectdesc1'],
									'projectStartDate' => $data['startdate1'],
									'projectEndDate' => $data['enddate1'],
									'projectVenue' => $data['venue1'],
									'projectLocation' => $data['location1'],
									'modifiedBy' => $data['modifiedBy'],
									'dateModified' => $data['dateModified'],
									'projectStatus' => $data['status1']]);

		if ($data['filename'] != '') {
			unlink("projects/".$data['imageName1']);
			$this->db->where('projectId =', $data['id1']);
			$this->db->update('projects', ['projectImage' => $data['filename']]);
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		}
		else {
			$this->db->trans_commit();
            return TRUE;
		}
	}

	/*----------------------------------
			END PROJECT SECTION
	----------------------------------*/
	/*-------------------------------
			ADMIN USER AUTHENTICATION
	----------------------------------*/

	public function getAllUsers()
	{
		$this->db->select('id, first_name, last_name, role, status, email, location, dob');
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('users');
		if($query->num_rows() > 0) {
			$record = $query->result();
			return array('rows' => $record, 'num' => count($record));
		}
	}

	public function updateUserDetails($data)
	{
		$this->db->where('id =', $data['userId']);
		return $this->db->update('users', ['first_name' => ucfirst(strtolower($data['firstname'])),
											'last_name' => ucfirst(strtolower($data['lastname'])),
											'email' => strtolower($data['email']),
											'dob' => $data['newdob'],
											'location' => ucfirst(strtolower($data['location'])),
											'role' => $data['role'],
											'status' => $data['status']]);
	}

	public function getUserId($identity)
	{
		$this->db->where('email=', $identity);
		$query = $this->db->get('users');
		return $query->row()->id;
	}
}
