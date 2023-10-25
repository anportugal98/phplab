<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
  // Constructor
  public function __construct()
  {
    parent::__construct();
    is_weekends();
    is_logged_in();
    is_checked_in();
    is_checked_out();
    $this->load->library('form_validation');
    $this->load->model('Public_model');
    $this->load->model('Admin_model');
  }

  // Dashboard
  public function index()
  {
    $dquery = "SELECT department_id AS d_id, COUNT(employee_id) AS qty FROM employee_department GROUP BY d_id";
    $d['d_list'] = $this->db->query($dquery)->result_array();
    $squery = "SELECT e.shift_id AS s_id, COUNT(e.id) AS qty, s.start, s.end FROM employee e inner join `shift` s on e.shift_id = s.id GROUP BY s_id";
    $d['s_list'] = $this->db->query($squery)->result_array();
    // Dashboard
    $d['title'] = 'Dashboard';
    $d['account'] = $this->Admin_model->getAdmin($this->session->userdata['username']);
    $d['display'] = $this->Admin_model->getDataForDashboard();

    $this->load->view('templates/dashboard_header', $d);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar');
    $this->load->view('admin/index', $d); // Dashboard Page
    $this->load->view('templates/dashboard_footer');
  }

  public function recordentry()
  {
    $d['title'] = 'RECORD ENTRY';
    $d['account'] = $this->Admin_model->getAdmin($this->session->userdata['username']);

    $this->load->view('templates/table_header', $d);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar');
    $this->load->view('recordentry/index', $d);
  }

   public function studentry()
  {
    $d['title'] = 'STUDENT ENTRY';
    $d['account'] = $this->Admin_model->getAdmin($this->session->userdata['username']);
     // Form Validation
    $this->form_validation->set_rules('s_num', 'Student No.', 'required|trim');
    $this->form_validation->set_rules('f_name', 'First Name', 'required|trim');
    $this->form_validation->set_rules('m_name', 'Middle Name', 'required|trim');
    $this->form_validation->set_rules('l_name', 'Last Name', 'required');
    $this->form_validation->set_rules('email', 'CvSU Email', 'required|trim|valid_email');
    $this->form_validation->set_rules('c_num', 'Contact No.', 'required|trim');
    $this->form_validation->set_rules('college', 'College', 'required|trim');
    $this->form_validation->set_rules('course', 'Course', 'required|trim');
    $this->form_validation->set_rules('section', 'Section', 'required|trim');
    $this->form_validation->set_rules('Adviser', 'Adviser', 'required|trim');

    if ($this->form_validation->run() == true) {
      $this->a_studentry();

    }

    $this->load->view('templates/table_header', $d);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar');
    $this->load->view('studentry/a_studentry', $d);
    $this->load->view('templates/table_footer');
  }

  private function a_studentry()
  {
    $StudentNo = $this->input->post('s_num');
    $fName = $this->input->post('f_name');
    $mdName = $this->input->post('m_name');
    $lName = $this->input->post('l_name');
    $CvEmail = $this->input->post('email');
    $ContactNo = $this->input->post('c_num');
    $College = $this->input->post('college');
    $Course= $this->input->post('course');
    $Section = $this->input->post('section');
    $Adviser = $this->input->post('Adviser');

    // Check Email
    $query = "SELECT * FROM tblstudentry WHERE CvEmail = '$CvEmail'";
    $checkEmail = $this->db->query($query)->num_rows();

    if ($checkEmail > 0) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger rounded-0 mb-2" role="alert">
      Email already used!</div>');
    }else{

      $data = [
        'StudentNo' => $StudentNo,
        'fName' => $fName,
        'mdName' => $mdName,
        'lname' => $lName,
        'CvEmail' => $CvEmail,
        'ContactNo' => $ContactNo,
        'College' => $College,
        'Course' => $Course,
        'Section' => $Section,
        'Adviser' => $Adviser,

      ];

      $this->db->insert('tblstudentry', $data);
      $getStud = $this->db->get_where('tblstudentry', ['email' => $data['email']])->row_array();
      // var_dump($getEmp);
      // die;
      $stud_id = $getStud['id'];
      $d = [
        'StudentNo' => $StudentNo,
        'fName' => $fName,
        'mdName' => $mdName,
        'lname' => $lName,
        'CvEmail' => $CvEmail,
        'ContactNo' => $ContactNo,
        'College' => $College,
        'Course' => $Course,
        'Section' => $Section,
        'Adviser' => $Adviser,
      ];

      $this->db->insert('tblstudentry', $d);
      $rows = $this->db->affected_rows();
      if ($rows > 0) {
        $this->session->set_flashdata('message', '<div class="alert alert-success rounded-0 mb-2" role="alert">
          Successfully added a new student!</div>');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger rounded-0 mb-2" role="alert">
          Failed to add data!</div>');
      }
      redirect('master/e_employee/'.$e_id);
    }
  }


}