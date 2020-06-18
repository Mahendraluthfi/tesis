<div class="content">
	<div class="page-inner">
		<div class="page-header">
			<h4 class="page-title">Data Wilayah</h4>
			<ul class="breadcrumbs">
				<li class="nav-home">
					<a href="<?php echo base_url() ?>">
						<i class="flaticon-home"></i>
					</a>
				</li>				
				<li class="separator">
					<i class="flaticon-right-arrow"></i>
				</li>
				<li class="nav-item">
					<a href="<?php echo base_url('wilayah') ?>">Data Wilayah</a>
				</li>
				<li class="separator">
					<i class="flaticon-right-arrow"></i>
				</li>
				<li class="nav-item">
					<a href="#">Lihat Koordinat</a>
				</li>
			</ul>
		</div>

		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="card">
					<div class="card-header">
						<div class="float-left">
						<h3>Koordinat <?php echo $get->kecamatan ?></h3>							
						</div>
						<div class="float-right">
							<a href="<?php echo base_url('wilayah') ?>" class="btn btn-default btn-sm"><i class="fas fa-chevron-left"></i> Kembali</a>
						</div>
					</div>
					<div class="card-body">
						<div id="map-markers" class="map-demo"></div>						
					</div>
				</div>
			</div>	
		</div>
	</div>
</div>


<script>
	$(document).ready(function(){		
		var mapMarkers = new GMaps({
			div: '#map-markers',
			lat: <?php echo $get->latitude ?>,
			lng: <?php echo $get->longitude ?>,
		});

		mapMarkers.addMarker({
			lat: <?php echo $get->latitude ?>,
			lng: <?php echo $get->longitude ?>,
			title: 'Koordinat Wilayah',
			details: {
				database_id: 42,
				author: 'Naka'
			},
			// click: function(e){
			// 	if(console.log)
			// 		console.log(e);
			// 	alert('You clicked in this marker');
			// }
		});
	});
</script>