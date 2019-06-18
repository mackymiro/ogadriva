<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Bonfire
 *
 * An open source project to allow developers to jumpstart their development of
 * CodeIgniter applications.
 *
 * @package   Bonfire
 * @author    Bonfire Dev Team
 * @copyright Copyright (c) 2011 - 2014, Bonfire Dev Team
 * @license   http://opensource.org/licenses/MIT The MIT License
 * @link      http://cibonfire.com
 * @since     Version 1.0
 * @filesource
 */

/**
 * Home controller
 *
 * The base controller which displays the homepage of the Bonfire site.
 *
 * @package    Bonfire
 * @subpackage Controllers
 * @category   Controllers
 * @author     Bonfire Dev Team
 * @link       http://guides.cibonfire.com/helpers/file_helpers.html
 *
 */
class Welcome extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('application');
		$this->load->library('Template');
		$this->load->library('Assets');
		$this->lang->load('application');
		$this->load->library('events');
		$this->load->model('records_model', 'rm');
        $this->load->library('installer_lib');
        if (! $this->installer_lib->is_installed()) {
            $ci =& get_instance();
            $ci->hooks->enabled = false;
            redirect('install');
        }

        // Make the requested page var available, since
        // we're not extending from a Bonfire controller
        // and it's not done for us.
        $this->requested_page = isset($_SESSION['requested_page']) ? $_SESSION['requested_page'] : null;
	}

	//--------------------------------------------------------------------
	//delete
	public function delete(){
		$this->load->library('users/auth');
		$this->set_current_user();
		
		$id = $this->input->post('id');
		$this->rm->delete($id);
		redirect('welcome/index');
		Template::render();
	}
	
	//edit successfully
	public function editSuccessfully(){
		$this->load->library('users/auth');
		$this->set_current_user();
		
		//update record
		$update = array(
					'first_name'=>$this->input->post('firstName'),
					'last_name'=>$this->input->post('lastName'),
					'position'=>$this->input->post('position'),
					'salary'=>$this->input->post('salary')
				 );
		$this->db->where('id', $this->input->post('recordId'))->update('bf_records', $update);
		Template::set_message('Successfully Updated A Record','success');
		redirect('welcome/edit/id/'.$this->input->post('recordId'));
		
		
	}
	
	//edit page
	public function edit(){
		$uri = $this->uri->segment(4);
		$this->load->library('users/auth');
		$this->set_current_user();
		$data['getRecord'] = $this->rm->getRecord($uri);
		Template::set('data', $data['getRecord']);
		
		Template::set_view('welcome/edit');
		Template::render();
		
	}
	
	//addRecord
	public function addRecord(){
	
		$this->form_validation->set_rules('firstName', 'First Name', 'trim|required', TRUE);
		$this->form_validation->set_rules('lastName', 'Last Name', 'trim|required', TRUE);
		$this->form_validation->set_rules('position', 'Position', 'trim|required', TRUE);
		$this->form_validation->set_rules('salary', 'Salary', 'trim|required', TRUE);
		if($this->form_validation->run() == FALSE){
			Template::set('data');
			Template::set_view('welcome/add');
			Template::render(); 
		}else{
			$dateCreated = date('Y-m-d H:i:s');
			$updatedAt = date('Y-m-d H:i:s');
			$array = array(
					'first_name'=>$this->input->post('firstName'),
					'last_name'=>$this->input->post('lastName'),
					'position'=>$this->input->post('position'),
					'salary'=>$this->input->post('salary'),
					'created_at'=>$dateCreated,
					'updated_at'=>$updatedAt
					);
			$this->rm->save($array);
			Template::set_message('Successfully Added A Record','success');
			redirect('welcome/add');
		}
	}
	//add
	public function add(){
		$this->load->library('users/auth');
		$this->set_current_user();

		Template::render();
	}
	
	/**
	 * Displays the homepage of the Bonfire app
	 *
	 * @return void
	 */
	public function index()
	{
		$this->load->library('users/auth');
		$this->set_current_user();
		$data['getAllRecords'] = $this->rm->getAllRecords();
		Template::set('data', $data['getAllRecords']);
		Template::render();
	}//end index()

	//--------------------------------------------------------------------

	/**
	 * If the Auth lib is loaded, it will set the current user, since users
	 * will never be needed if the Auth library is not loaded. By not requiring
	 * this to be executed and loaded for every command, we can speed up calls
	 * that don't need users at all, or rely on a different type of auth, like
	 * an API or cronjob.
	 *
	 * Copied from Base_Controller
	 */
	protected function set_current_user()
	{
        if (class_exists('Auth')) {
			// Load our current logged in user for convenience
            if ($this->auth->is_logged_in()) {
				$this->current_user = clone $this->auth->user();

				$this->current_user->user_img = gravatar_link($this->current_user->email, 22, $this->current_user->email, "{$this->current_user->email} Profile");

				// if the user has a language setting then use it
                if (isset($this->current_user->language)) {
					$this->config->set_item('language', $this->current_user->language);
				}
            } else {
				$this->current_user = null;
			}

			// Make the current user available in the views
            if (! class_exists('Template')) {
				$this->load->library('Template');
			}
			Template::set('current_user', $this->current_user);
		}
	}
}
/* end ./application/controllers/home.php */
