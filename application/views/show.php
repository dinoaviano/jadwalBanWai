<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" >
	<link href="https://fonts.googleapis.com/css?family=Mina" rel="stylesheet">
	<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<style>
		body{
			font-family: 'Mina', 'Segoe UI';
			background-image: url("<?php echo base_url(); ?>assets/img/body.jpg");
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
			font-size: 35pt;

		}
		table li{
			font-size: 35pt;			
		}
		ul{
			/*list-style-image: url('https://image.flaticon.com/icons/png/128/78/78016.png');*/
		}
		th{
			font-size: 22pt;
			text-align: center;		}
		.big{
			font-size: 30pt;
		}
		.medium{
			font-size: 25pt;
			text-align: center;
		}
		.marquee {
			margin-top:0;
		    position: relative;
		    box-sizing: border-box;
		    animation: marquee 15s linear infinite;
		}
		@keyframes marquee{
			from{
				margin-top: 0;
			}to{
				margin-top:-50%;
			}
		}
		.table-wrap{
			overflow: hidden;
		    position: relative;
		    box-sizing: border-box;
		}
	</style>
</head>
<body>
	<div id="wrapper">
		<div style="font-size: 30pt;">
			<img src="<?php echo base_url(); ?>assets/img/kemenkumham.jpg" style="float: left;margin:1%;width: 10%;max-width: 100pt;"/>
  			<span style="float: left;width: 75%;text-align: center;">
  				<b>JADWAL / RENCANA GIAT<br>BAGIAN KEPEGAWAIAN</b>
  			</span>
  			<img src="<?php echo base_url(); ?>assets/img/imi.jpg" style="margin:1%;right: 0;width: 10%;max-width: 100pt;" />
  		</div>
	  	<p style="color: grey;font-size: 28pt;background-color:white;letter-spacing: 5px;padding: 1%">
	  		Tanggal : <?php echo $datenow; ?>
	  	</p>
	  	<div class="table-wrap">
		<table class="table table-bordered <?php if($count>2){echo 'marquee';}?>">
	  		<thead>
	      		<tr class="table-light" align="center">
			      <th scope="col" style="vertical-align: middle">NO</th>
			      <th scope="col" style="vertical-align: middle">NAMA KEGIATAN</th>
			      <th scope="col" style="vertical-align: middle">PENANGGUNG JAWAB</th>
			      <th scope="col" style="vertical-align: middle">TEMPAT/WAKTU</th>
			      <th scope="col" style="vertical-align: middle">PROGRES SELESAI</th>
			      <th scope="col" style="vertical-align: middle">PROGRES KEDEPAN</th>
			    </tr>
		  	</thead>
		  	<tbody style="color:white;">
		    		<?php
		    			$i=1;
		    			foreach ($kegiatan as $keg) {
		    				$sisa_waktu = ceil((strtotime($keg->tgl)-time())/60/60/24);
		    				if($sisa_waktu == 0){
		    					$sisa_waktu == "HARI INI";
		    				}else{
		    					$sisa_waktu = "(".$sisa_waktu." Hari Lagi)";
		    				}
		    	echo "<tr>";
		    		echo "<td><b>".$i.".</b></td>";
		    		echo "<td><b>".$keg->nama."</b></td>";
		    		echo "<td><b>".$subag[$keg->pelaksana-1]->nama_sub."</b></td>";
		    		echo "<td style='font-size:25pt;'><b><center>".$keg->tempat."<hr>".date('d-M-Y',strtotime($keg->tgl))."</br>".$keg->waktu."</br><p style='font-size:25pt;'>".$sisa_waktu."</p></center></td>";
		    		
		    		
		    		echo "</td>";
		    		echo "<td><ul>";
		    		foreach ($progres as $pro) {
		    			if($pro->id_kegiatan == $keg->id && $pro->selesai == 1){
		    				echo "<li>".$pro->nama."</li>";
		    			}
		    		}
		    		echo "<td><ul>";
		    		foreach ($progres as $pro) {
		    			if($pro->id_kegiatan == $keg->id && $pro->selesai == 0){
		    				echo "<li><b>".$pro->nama."</b></li>";
		    			}
		    		}
		    		echo "</td>";
		    		echo "</ul></td>";
			    echo "</tr>";
			    $i++;
		    			}
		    		?>
			 </tbody>
		</table>
		</div>
	</div>
	<script>
		console.log($('.table').height());
	</script>
</body>
</html>