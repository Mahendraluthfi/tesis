<div class="content">
	<div class="page-inner">
		<div class="page-header">
			<h4 class="page-title">Data Wilayah</h4>
			<ul class="breadcrumbs">
				<li class="nav-home">
					<a href="#">
						<i class="flaticon-home"></i>
					</a>
				</li>				
				<li class="separator">
					<i class="flaticon-right-arrow"></i>
				</li>
				<li class="nav-item">
					<a href="#">Data Wilayah</a>
				</li>
			</ul>
		</div>

		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="card">
					<div class="card-header">
						<button type="button" onclick="add()" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Data</button>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="basic-datatables" class="display table table-bordered table-striped" >
								<thead>
									<tr>
										<th width="5%">No</th>
										<th>Wilayah</th>
										<th>Latitude</th>
										<th>Longitude</th>
										<th width="15%">#</th>										
									</tr>
								</thead>							
								<tbody>
									<?php $no=1; foreach ($get as $data) { ?>
										<tr>
											<td><?php echo $no++ ?></td>
											<td><?php echo $data->kecamatan ?></td>
											<td><?php echo $data->latitude ?></td>
											<td><?php echo $data->longitude ?></td>
											<td>
												<button type="button" class="btn btn-success btn-sm" onclick="edit('<?php echo $data->id_wilayah ?>')"><i class="fas fa-edit"></i></button>
												<a href="<?php echo base_url('wilayah/vmap/'.$data->id_wilayah) ?>" class="btn btn-warning btn-sm"><i class="fas fa-map-marker-alt"></i></a>												
												<a href="<?php echo base_url('wilayah/delete/'.$data->id_wilayah) ?>" onclick="return confirm('Yakin hapus ?')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
</div>

<div class="modal fade" id="modal-id">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"></h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<form id="form" method="POST" class="form-horizontal" role="form">
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Nama Wilayah</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="kecamatan" placeholder="Nama Wilayah">
					    </div>
					</div>	
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Latitude</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="latitude" placeholder="Koordinat Latitude">
					    </div>
					</div>	
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Longitude</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="longitude" placeholder="Koordinat Longitude">
					    </div>
					</div>																	
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" onclick="save()" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>


<script>

	var save_method; 
    var table;
    var gid;

	function add() {
		save_method = 'add';
      	$('#form')[0].reset();
		$('.modal-title').text('Tambah Data Wilayah');
		$('#modal-id').modal('show');
	}

	function save() {
	 	var url;      
      	if(save_method == 'add'){
          url = "<?php echo base_url('wilayah/save')?>";          
      	}else{          
          url = "<?php echo base_url('wilayah/edit/')?>" + gid;         
      	}    
       	// ajax adding data to database
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modal-id').modal('hide');
              location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
	}

	function edit(id)
    {
      save_method = 'update';
      gid = id;
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo base_url('wilayah/get')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            // $('#kabkot').trigger('change');  
            $('[name="kecamatan"]').val(data.kecamatan);                        
            $('[name="latitude"]').val(data.latitude);                        
            $('[name="longitude"]').val(data.longitude);                        
            $('.modal-title').text('Edit Data Wilayah'); // Set title to Bootstrap modal title
            $('#modal-id').modal('show'); // show bootstrap modal when complete loaded

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
      });
    }    

</script>