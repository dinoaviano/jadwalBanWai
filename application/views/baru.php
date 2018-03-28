<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" >
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datatables.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/dataTables.bootstrap4.min.css" />
	

	<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datatables.min.js"></script> 
	<!-- <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  	<script>tinymce.init({ selector:'textarea' });</script> -->
	<style>
		body{
			background-image: url("<?php echo base_url(); ?>assets/img/body.jpg");
			background-repeat: no-repeat, repeat;
			background-size: cover;
		}
		#wrapper{
			margin-right: auto; /* 1 */
			margin-left:  auto; /* 1 */
			width: 100% ;
			max-width: 1600px; /* 2 */

			padding-right: 10px; /* 3 */
			padding-left:  10px; /* 3 */
		}
		table{
			font-size: 12pt;
		}
		ul{
			/*list-style-image: url('https://image.flaticon.com/icons/png/128/78/78016.png');*/
		}
		th{
			text-align: center;
		}
		.big{
			font-size: 25pt;
		}
		.medium{
			font-size: 20pt;
			text-align: center;
		}
	</style>
</head>
<body>
	<div id="wrapper">
		<div style="font-size: 30pt;">
			<img src="<?php echo base_url(); ?>assets/img/kemenkumham.jpg" style="float: left;margin:1%;width: 10%;max-width: 100pt;"/>
  			<span style="float: left;width: 75%;text-align: center;">
  				<b>INPUT JADWAL / RENCANA GIAT<br>BAGIAN KEPEGAWAIAN</b>
  			</span>
  			<img src="<?php echo base_url(); ?>assets/img/imi.jpg" style="margin:1%;right: 0;width: 10%;max-width: 100pt;" />
  		</div>
		<div class="modal fade" id="newMdl" tabindex="-1" role="dialog" aria-labelledby="editMdlLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h3 class="modal-title" id="newMdlLabel">Tambah Jadwal</h3>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			     <div class="modal-body">
					<form method="post" action="update/new">
					  	<div class="container">
							<div class="row">
								  <div class="form-group">
								    <label for="nama">Nama Kegiatan</label>
								    <input type="text" id="nama" class="form-control" placeholder="Nama Kegiatan" name="nama" required>
								  </div>
							</div>
							<div class="row">
								<div class="form-group">
									<label for="pelaksana">Pelaksana</label>
								    <select style="height:30pt;" class="form-control" name="pel" id="pelaksana">
								   	<?php 
								   	 	foreach ($subag as $sub) {
								   	 		echo "<option  value='".$sub->id."'>".$sub->nama_sub."</option>";
								   	 	}
								   	?>
								    </select>
								</div>
							</div>
							<div class="row">
								  <div class="form-group">
								    <label for="tgl">Tanggal Pelaksanaan</label>
								    <input type="date" id="tgl" class="form-control"  name="tgl" value="<?php echo date('Y-m-d');?>" required>
								  </div>
							</div>
							<div class="row">
								  <div class="form-group">
								    <label for="tmp">Tempat Pelaksanaan</label>
								    <input type="text" id="tmp" class="form-control" name="tempat" placeholder="Tempat Pelaksanaan" required>
								  </div>
							</div>
							<div class="row">
								  <div class="form-group">
								    <label for="time">Waktu Pelaksanaan</label>
								    <input type="time" id="time" class="form-control" name="time" value="09:00" required>
								  </div>
							</div>
							<div class="row">
								  <div class="form-group">
								    <label for="nama">Progres</label>
								    <input type="text" required id="prog" class="form-control" name="prog[]">
								    <div id="progres"></div>
								  </div>
							</div>
							<div class="row">
								  <div class="form-group">
								  	<br><br>
								    <input type="submit" class="form-control btn-success"  value="Tambah Jadwal Kegiatan baru">
								  </div>
							</div>
						</div>
					</form>
					<div class="container">
						<div class="row">
						  	<div class="form-group">
							  	<button id="btnAppend" class="btn btn-primary" style="margin-top:-140pt;">Tambah 
								  Progres</button>
							</div>
						</div>
				 	</div>
				 	</div>
				</div>
			</div>
		</div>
	   		&nbsp <button class="btn btn-success" data-toggle="modal" data-target="#newMdl">Tambah Jadwal Kegiatan</button>
			<br><br>
			<table class="table table-striped table-bordered" id="tbl">
		  		<thead>
		      		<tr class="table-light" align="center">
				      <th scope="col" style="vertical-align: middle">NO</th>
				      <th scope="col" style="vertical-align: middle">NAMA KEGIATAN</th>
				      <th scope="col" style="vertical-align: middle">PENANGGUNG JAWAB</th>
				      <th scope="col" style="vertical-align: middle">TEMPAT/WAKTU</th>
				      <th scope="col" style="vertical-align: middle">PROGRES SELESAI</th>
				      <th scope="col" style="vertical-align: middle">PROGRES KEDEPAN</th>
				      <th scope="col" style="vertical-align: middle">AKSI</th>
				    </tr>
			  	</thead>
			  	<tbody>
			    	<?php
		    			$i=1;
			    		foreach ($kegiatan as $keg) {
			    			$sisa_waktu = ceil((strtotime($keg->tgl)-time())/60/60/24);
			    			if($sisa_waktu < 1 || $sisa_waktu == "-0"){
			    				$sisa_waktu == "HARI INI";
			    			}else{
			    				$sisa_waktu = "(".$sisa_waktu." Hari Lagi)";
			    			}
					?>
			    	<tr>
				    	<div class="modal fade" id="editMdl<?php echo $keg->id;?>" tabindex="-1" role="dialog" aria-labelledby="editMdlLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h3 class="modal-title" id="editMdlLabel">Ubah Data Jadwal</h3>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
									<form method="post" action="update">
									  	<div class="container">
											<div class="row">
												  <div class="form-group">
												    <label for="nama">Nama Kegiatan</label>
												    <input type="hidden" name="id" value="<?php echo $keg->id; ?>"/>
												    <input style="width:200%" type="text" id="nama" class="form-control" placeholder="Nama Kegiatan" name="nama" value="<?php echo $keg->nama; ?>">
												  </div>
											</div>
											<div class="row">
												<div class="form-group">
													<label for="pelaksana">Pelaksana</label>
												    <select style="height:30pt;" class="form-control" name="pel" id="pelaksana">
											    	<?php 
											    	 	foreach ($subag as $sub) {
											    	 		if($sub->id == $keg->pelaksana){
											    	 			echo "<option  selected value='".$sub->id."'>".$sub->nama_sub."</option>";
											    	 		}else{
											    	 			echo "<option  value='".$sub->id."'>".$sub->nama_sub."</option>";
											    	 		}
											    	 	}
											    	?>
												    </select>
												</div>
											</div>
											<div class="row">
												  <div class="form-group">
												    <label for="nama">Tempat Kegiatan</label>
												    <input style="width:200%" type="text" id="tempat" class="form-control" placeholder="Tempat Kegiatan" name="tempat" value="<?php echo $keg->tempat; ?>">
												  </div>
											</div>
											<div class="row">
												<div class="form-group">
													<label for="tgl">Tanggal diadakan</label>
													<input type="date" class="form-control" id="tgl" name="tgl" value="<?php echo $keg->tgl; ?>">
												</div>
												<div class="form-group">
													<label for="time">Waktu</label>
													<input type="time" class="form-control" id="time" name="time" value="<?php echo $keg->waktu; ?>">
												</div>
											</div>
											<div class="row">
												<div class="form-group">
													<label for="prog1">Target Progres </label>
													<?php
														foreach ($progres as $p) {
															if($p->id_kegiatan == $keg->id){
													?>
													<div class="form-group">
														<input type="hidden" value="<?php echo $p->id;?>" name="id_progres[]" />
														<input class="form-control" type="text" id="prog1" value="<?php echo $p->nama;?>" name="prog[]">
													</div>
													<?php
															}
														}
													?>
												</div>
											</div>
											<div class="row">
												<br><br>
											</div>
											<div class="row">
												<div class="form-group">
												    <input type="submit" class="form-control btn-primary" value="Ubah Jadwal"/>
												</div>
												<div class="form-group">
													<button type="button" class="form-control btn-secondary" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</form>
								</div>
						    </div>
						  </div>
						</div>
						<div class="modal fade" id="editPMdl<?php echo $keg->id;?>" tabindex="-1" role="dialog" aria-labelledby="editMdlLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
							    <div class="modal-content">
								    <div class="modal-header">
								        <h3 class="modal-title" id="editMdlLabel">Ubah Data Jadwal</h3>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								    </div>
								    <div class="modal-body">
										<form method="post" action="update/update_progres">
										  	<div class="container">
												<div class="row">
													<div class="form-group">
													    <h3><?php echo $keg->nama; ?></h3>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<label for="prog1">Target Progres (checklist jika progres selesai)</label>
														<input type="hidden" value="<?php echo $keg->id; ?>" name="id_kegiatan"/>
														<?php
															foreach ($progres as $p) {
																if($p->id_kegiatan == $keg->id){
														?>
														<div class="form-check">
														    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="prog[]" value="<?php echo $p->id;?>"
														    <?php
														    	if($p->selesai == 1){
														    		echo "checked";
														    	}
														    ?>
														    >
														    <label class="form-check-label" for="exampleCheck1"><?php echo $p->nama;?></label>
														  </div>
														<?php
																}
															}
														?>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
													    <input type="submit" class="form-control btn-primary" value="Ubah Progres"/>
													</div>
													<div class="form-group">
														<button type="button" class="form-control btn-secondary" data-dismiss="modal">Close</button>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade" id="newPMdl<?php echo $keg->id;?>" tabindex="-1" role="dialog" aria-labelledby="editMdlLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
							    <div class="modal-content">
								    <div class="modal-header">
								        <h3 class="modal-title" id="editMdlLabel">Tambah progres Kedepan</h3>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								    </div>
								    <div class="modal-body">
										<form method="post" action="update/new_progres">
										  	<div class="container">
												<div class="row">
													<div class="form-group">
													    <h3><?php echo $keg->nama; ?></h3>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<label for="prog1">Target Progres Kedepan</label>
														<input type="hidden" value="<?php echo $keg->id; ?>" name="id_kegiatan"/>
														
														<div class="form-group">
														    <input type="text" class="form-control" id="exampleCheck1" name="prog">
														    <label class="form-check-label" for="exampleCheck1"><?php echo $p->nama;?></label>
														  </div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
													    <input type="submit" class="form-control btn-primary" value="Tambah Progres"/>
													</div>
													<div class="form-group">
														<button type="button" class="form-control btn-secondary" data-dismiss="modal">Close</button>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade" id="delMdl<?php echo $keg->id;?>" tabindex="-1" role="dialog" aria-labelledby="editMdlLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
							    <br><br><br><br><br><br><br><br>
							    <div class="modal-content">
									<div class="modal-header">
								        <h3 class="modal-title" id="editMdlLabel">Ubah Data Jadwal</h3>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								    </div>
								    <div class="modal-body">
										Apakah anda yakin ingin menghapus jadwal?
									</div>
									<div class="modal-footer">
									  	<form method="post" action="update/delete">
											<dic class="container">
												<div class="row">
													<div class="form-group">
														<input type="hidden" name="id" value="<?php echo $keg->id; ?>">
													    <input type="submit" class="form-control btn-danger" name="submit" value="Hapus Jadwal"/>
													</div>
													<div class="form-group">
														<button type="button" class="form-control btn-secondary" data-dismiss="modal">Tutup</button>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<?php
			    			echo "<td>".$i.".</td>";
			    			echo "<td><b>".$keg->nama."</b></td>";
			    			echo "<td>".$subag[$keg->pelaksana-1]->nama_sub."</td>";
			    			echo "<td><b><center>".$keg->tempat."<hr>".date('d-m-Y',strtotime($keg->tgl))."</br>".$keg->waktu."</br>".$sisa_waktu."</center></td>";
			    			echo "<td><ul>";
			    			foreach ($progres as $pro) {
			    				if($pro->id_kegiatan == $keg->id && $pro->selesai == 1){
			    					echo "<li>".$pro->nama."</li>";
			    				}
			    			}
			    			echo "</td>";
			    			echo "<td><ul>";
			    			foreach ($progres as $pro) {
			    				if($pro->id_kegiatan == $keg->id && $pro->selesai == 0){
			    					echo "<li>".$pro->nama."</li>";
			    				}
			    			}
			    			echo "</td>";
			    		?>
						<td>
							<button type="button" data-toggle="modal" data-target="#newPMdl<?php echo $keg->id;?>" class="btn btn-warning
						 btn-sm btn-block">
						   		<span class="glyphicon glyphicon-pencil"></span> Tambah Progres Kedepan
					        </button>
							<button type="button" data-toggle="modal" data-target="#editPMdl<?php echo $keg->id;?>" class="btn btn-primary btn-sm btn-block">
						   		<span class="glyphicon glyphicon-pencil"></span> Update Progres 
					        </button>
							<button type="button" data-toggle="modal" data-target="#editMdl<?php echo $keg->id;?>" class="btn btn-primary btn-sm btn-block">
							    <span class="glyphicon glyphicon-pencil"></span> Update Detail 
							</button>
					    	<button type="button" data-toggle="modal" data-target="#delMdl<?php echo $keg->id;?>" class="btn btn-danger btn-sm btn-block">
							    <span class="glyphicon glyphicon-remove"></span> Hapus 
							</button>
					    </td>
				    </tr>	
		 	<?php
				$i++;
    			}
    		?>
			</tbody>
		</table>
	<script type="text/javascript">
			$(document).ready(function() {
			    $('#tbl').DataTable();
			    $("#btnAppend").click(function(){
			      $("#progres").append("<input type='text' id='prog' class='form-control' name='prog[]'>");
			    });
			});
			$('#newMdl').on('shown.bs.modal', function () {
			  $('#myInput').trigger('focus')
			})
			$('#newPMdl').on('shown.bs.modal', function () {
			  $('#myInput').trigger('focus')
			})
			$('#editMdl').on('shown.bs.modal', function () {
			  $('#myInput').trigger('focus')
			})

			$('#edit2Mdl').on('shown.bs.modal', function () {
			  $('#myInput').trigger('focus')
			})

			$('#delMdl').on('shown.bs.modal', function () {
			  $('#myInput').trigger('focus')
			})
	</script>
</div>
</body>
</html>