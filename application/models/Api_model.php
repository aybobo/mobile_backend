<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {

 /*=======================================================
        EVENTS API SECTION
    ========================================================
*/

	public function fetchAllEvent()
    {
        $this->db->select('eventId, eventName, eventDesc, venue, eventLocation, eventStartDate, eventStartTime, eventEndDate, eventEndTime, eventFlier, eventStatus');
        $this->db->where('eventStatus =', 'Upcoming');
        $this->db->order_by('eventDateForAdmin', 'ASC');
        $query = $this->db->get('events');
        return $query->result();
    }

    public function getEventFiles()
    {
        $this->db->order_by('id');
        $query = $this->db->get('eventfiles');
        return $query->result();
    }

    public function attendEvent($data)
    {
        $this->db->trans_begin();
        $this->db->where('id =', $data['userId']);
        $output = $this->db->get('users');
        $data['fullName'] = $output->row()->first_name . ' ' . $output->row()->last_name;
        $data['location'] = $output->row()->location;
        $result['fullName'] = $output->row()->first_name . ' ' . $output->row()->last_name;
        $result['email'] = $output->row()->email;

        $this->db->insert('event_attendees', $data);

        $this->db->where('eventId =', $data['eventId']);
        $query = $this->db->get('events');
        $result['eventName'] = $query->row()->eventName;
        $num = $query->row()->numberOfEventAttendees;
        $num += 1;

        $this->db->where('eventId =', $data['eventId']);
        $this->db->update('events', ['numberOfEventAttendees' => $num]);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }
        else {
            $this->db->trans_commit();
            return $result;
        }
    }

    public function fetchSingleEvent($id)
    {
        $this->db->select('eventId, eventName, eventDesc, venue, eventLocation, eventStartDate, eventStartTime, eventEndDate, eventEndTime, eventFlier, eventStatus');
        $this->db->where('eventId =', $id);
        $query = $this->db->get('events');
        return $query->row(); 
    }

    public function getSingleEventFiles($id)
    {
        $this->db->where('eventId =', $id);
        $query = $this->db->get('eventfiles');
        return $query->result();
    }


 /*=======================================================
        END EVENTS API SECTION
========================================================
*/

 /*=======================================================
        NEWS API SECTION
========================================================
*/
    public function fetchAllNews()
    {
        $this->db->select('newsId, title, information, newsImage, entryDate, newsStatus');
        $this->db->where('newsStatus =', 'Active');
        $this->db->order_by('createDate', 'DESC');
        $query = $this->db->get('newsarticles');
        return $query->result();
    }

    public function getAllNewsFiles()
    {
        $this->db->order_by('id');
        $query = $this->db->get('newsfiles');
        return $query->result();
    }

    public function fetchSingleNews($id)
    {
        $this->db->select('newsId, title, information, newsImage, entryDate, newsStatus');
        $this->db->where('newsId =', $id);
        $query = $this->db->get('newsarticles');
        return $query->row();
    }

    public function fetchSingleNewsFiles($id)
    {
        $this->db->where('newsId =', $id);
        $query = $this->db->get('newsfiles');
        return $query->result();
    }

 /*=======================================================
        END NEWS API SECTION
========================================================
*/

 /*=======================================================
        PROJECTS API SECTION
========================================================
*/

public function fetchSingleProject($id)
{
    $this->db->select('projectId, projectTitle, projectDescription, projectVenue, projectLocation, projectImage, projectStartDate, projectEndDate, projectStatus');
    $this->db->where('projectId =', $id);
    $query = $this->db->get('projects');
    return $query->row();
}

public function fetchSingleProjectFiles($id)
{
    $this->db->select('projectId, fileUrl, fileExt');
    $this->db->where('projectId =', $id);
    $query = $this->db->get('projectfiles');
    return $query->result();
}

public function fetchCompletedProjects()
{
    $this->db->select('projectId, projectTitle, projectDescription, projectVenue, projectLocation, projectImage, projectStartDate, projectEndDate, projectStatus');
    $this->db->where('projectStatus =', 'Completed');
    $this->db->order_by('projectEndDate', 'DESC');
    $query = $this->db->get('projects');
    return $query->result();
}

public function fetchCompletedFiles()
{
    $this->db->select('projectId, fileUrl, fileExt');
    $this->db->where('projectStatus =', 'Completed');
    $query = $this->db->get('projectfiles');
    return $query->result();
}

public function fetchPendingProjects()
{
    $this->db->select('projectId, projectTitle, projectDescription, projectVenue, projectLocation, projectImage, projectStartDate, projectEndDate, projectStatus');
    $this->db->where('projectStatus =', 'Pending');
    $this->db->order_by('projectStartDate', 'ASC');
    $query = $this->db->get('projects');
    return $query->result();
}

public function fetchPendingProjectFiles()
{
    $this->db->select('projectId, fileUrl, fileExt');
    $this->db->where('projectStatus =', 'Pending');
    $query = $this->db->get('projectfiles');
    return $query->result();
}

public function fetchInProgressProjects()
{
    $this->db->select('projectId, projectTitle, projectDescription, projectVenue, projectLocation, projectImage, projectStartDate, projectEndDate, projectStatus');
    $this->db->where('projectStatus =', 'In Progress');
    $this->db->order_by('projectStartDate', 'DESC');
    $query = $this->db->get('projects');
    return $query->result();
}

public function fetchInProgressProjectFiles()
{
    $this->db->select('projectId, fileUrl, fileExt');
    $this->db->where('projectStatus =', 'In Progress');
    $query = $this->db->get('projectfiles');
    return $query->result();
}

/*=======================================================
   END PROJECTS API SECTION
========================================================
*/

 /*=======================================================
        WINNERS API SECTION
========================================================
*/
public function fetchAllWinners()
{
    $this->db->select('*');
    $this->db->from('winners');
    $this->db->join('users', 'users.userId = winners.userId');
    $this->db->join('promotions', 'promotion.promoId = winners.promoId');
    $this->db->order_by('winners.entryDate','ASC');
    $query = $this->db->get();
    return $query->result();
}

/*=======================================================
   END WINNERS API SECTION
========================================================
*/

/*=======================================================
        PROMOTIONS API SECTION
========================================================
*/
public function fetchAllOngoingPromotions()
{
    $this->db->order_by('startDate', 'ASC');
    $this->db->where('status =', 1);
    $query = $this->db->get('promotions');
    return $query->result();
}

/*=======================================================
   END PROMOTIONS API SECTION
========================================================
*/

/*=======================================================
        USERS API SECTION
========================================================
*/

public function addNewUser($data)
{
    return $this->db->insert('users', $data);
}

public function getRegisteredUsers()
{
    $this->db->select('id, first_name, last_name, email, password, location, dob');
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get('users');
    return $query->result();
}

public function checkIfEmailExists($email)
{
    $this->db->where('email =', $email);
    $query = $this->db->get('users');
    return $query->row();
}

public function checkUserInEvent($data)
{
    $this->db->where('userId =', $data['userId']);
    $this->db->where('eventId =', $data['eventId']);
    $query = $this->db->get('event_attendees');
    return $query->row();
}

/*=======================================================
   END USERS API SECTION
========================================================
*/

}
