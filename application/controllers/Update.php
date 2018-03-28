<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$update = $this->input->post();

		$n = count($update['prog']);
		print_r($update);
		$update['del'] = array();
		for($i=0;$i<$n;$i++){
			if(empty($update['prog'][$i])){
				// echo "kosong".$i.$update['id_progres'][$i];
				array_push($update['del'],$update['id_progres'][$i]);
				unset($update['id_progres'][$i]);
				unset($update['prog'][$i]);
				// array_pop($update['id_progres']);
				// array_pop($update['prog']);
			}
		}
		$this->load->model('jadwal_model');
		$this->jadwal_model->update_jadwal($update);

		$data['kegiatan'] = $this->jadwal_model->get_all_kegiatan();
		$data['progres'] = $this->jadwal_model->get_all_progres();
		$data['subag'] = $this->jadwal_model->get_all_subag();
		$data['datenow'] = date("d-m-Y");
	
		redirect('/input', 'refresh');
	}
	public function new(){
		$new = $this->input->post();
		$n = count($new['prog']);
		$i=0;
		for($i=0;$i<$n;$i++){
			if($new['prog'][$i] == ""){
				unset($new['prog'][$i]);
			}
		}
		$this->load->model('jadwal_model');
		$this->jadwal_model->add_jadwal($new);
		print_r($new);
		// $data['kegiatan'] = $this->jadwal_model->get_all_kegiatan();
		// $data['progres'] = $this->jadwal_model->get_all_progres();
		// $data['subag'] = $this->jadwal_model->get_all_subag();
		// $data['datenow'] = date("d-m-Y");
		redirect('/input', 'refresh');
	}
	public function update_progres(){
		$progres = $this->input->post();
		// print_r($progres);
		$this->load->model('jadwal_model');
		$this->jadwal_model->update_progres($progres);

		redirect('/input', 'refresh');
	}
	public function new_progres(){
		$baru = $this->input->post();
		$this->load->model('jadwal_model');
		$this->jadwal_model->new_progres($baru);
		
		redirect('/input', 'refresh');
	}
	public function delete(){
		$del = $this->input->post();
		$this->load->model('jadwal_model');
		$this->jadwal_model->del_jadwal($del['id']);

		// $data['kegiatan'] = $this->jadwal_model->get_all_kegiatan();
		// $data['progres'] = $this->jadwal_model->get_all_progres();
		// $data['subag'] = $this->jadwal_model->get_all_subag();
		// $data['datenow'] = date("d-m-Y");
		redirect('/input', 'refresh');
	}
}

