<?php
class Jadwal_model extends CI_Model {

        public $id;
        public $nama;
        public $selesai;
        public $id_keg;
        function __construct(){
            parent::__construct(); // construct the Model class
        }
        public function get_all_progres(){
                $query = $this->db->get('progres');
                return $query->result();
        }
        public function get_all_kegiatan(){
                $query = $this->db->query('select * from kegiatan where tgl >= CURDATE() order BY tgl');
                return $query->result();
        }
        public function get_all_subag(){
                $query = $this->db->get('subag');
                return $query->result();
        }
        public function get_progres_by_kegiatan(){
                $query = $this->db->get_where('progres', array('id_keg' => $id_keg));
                return $query->result();
        }
        public function update_jadwal($update){
                //update detail kegiatan
                $data = array(
                        'nama'=> $update['nama'],
                        'pelaksana'=> $update['pel'],
                        'tgl'=> $update['tgl'],
                        'waktu'=> $update['time'],
                        'tempat'=> $update['tempat']
                );
                // print_r($update);
                $count = count($update['del']);
                for($i=0;$i<$count;$i++){
                        $this->db->where('id', $update['del'][$i]);
                        $this->db->delete('progres');
                }
        
                $this->db->where('id', $update['id']);
                $this->db->update('kegiatan', $data);
                //update nama progres
                $id_progres = array();
                $id_progres = $update['prog'];
                
                $n = count($id_progres);
                for($i = 0; $i<$n; $i++){
                        $progres = array(
                                'nama' => $update['prog'][$i]
                        );
                        $this->db->where('id', $id_progres[$i]);
                        $this->db->update('progres', $progres);
                }
        }
        public function update_progres($update){
                $this->db->set('selesai','0');
                $this->db->where('id_kegiatan', $update['id_kegiatan']);
                $this->db->update('progres');
                
                $n = count($update['prog']);
                for($i=0;$i<$n;$i++){
                        $this->db->set('selesai','1');
                        $this->db->where('id', $update['prog'][$i]);
                        $this->db->update('progres');
                }
        }
        public function add_jadwal($new)
        {
                print_r($new);
                $data = array(
                        'nama' => $new['nama'],
                        'pelaksana' => $new['pel'],
                        'tgl' => $new['tgl'],
                        'waktu'=> $new['time'],
                        'tempat' => $new['tempat']
                );
                

                $this->db->insert('kegiatan', $data);
                $q = "SELECT id FROM kegiatan order by id desc limit 1";
                $q = $this->db->query($q)->result();
                
                if(isset($q[0])){
                        $max = $q[0]->id;
                }else{
                        $max = 1;
                }
                $count = count($new['prog']);
                for($i=0;$i<$count;$i++){
                        $data_prog = array(
                                'nama' => $new['prog'][$i],
                                'selesai' => 0,
                                'id_kegiatan' => $max
                        );
                        $this->db->insert('progres', $data_prog);
                }
        }
        public function new_progres($baru){
                $data = array(
                        'nama' => $baru['prog'],
                        'selesai' => 0,
                        'id_kegiatan' => $baru['id_kegiatan']
                );
                $this->db->insert('progres', $data);
        }
        public function del_jadwal($del){
                $this->db->where('id', $del);
                $this->db->delete('kegiatan');


                $this->db->where('id_kegiatan', $del);
                $this->db->delete('progres');
        }
}
?>