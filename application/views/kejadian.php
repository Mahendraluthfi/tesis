<div class="content">
	<div class="page-inner">
		<div class="page-header">
			<h4 class="page-title">Data Kejadian Kejahatan</h4>
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
					<a href="#">Data Kejadian Kejahatan</a>
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
										<th>Jenis Kejahatan</th>
										<th>Tanggal</th>
										<th>Uraian</th>
										<th>Tersangka</th>
										<th>#</th>										
									</tr>
								</thead>							
								<tbody>
									<?php $no=1; foreach ($get as $data) { ?>
										<tr>
											<td><?php echo $no++ ?></td>
											<td><?php echo $data->kecamatan ?></td>
											<td><?php echo $data->jenis_kejahatan ?></td>
											<td><?php echo date('d M Y', strtotime($data->date)) ?></td>
											<td><?php echo $data->uraian ?></td>
											<td><?php echo $data->tersangka ?></td>
											<td>
												<button type="button" class="btn btn-success btn-sm" onclick="edit('<?php echo $data->id ?>')"><i class="fas fa-edit"></i></button>
												<a href="<?php echo base_url('kejadian/delete/'.$data->id) ?>" onclick="return confirm('Yakin hapus ?')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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
					    	<select name="id_wilayah" class="form-control wilayah" required="">
					    		<option value="" selected="">Pilih</option>
					    		<?php foreach ($wilayah as $data) { ?>
					    			<option value="<?php echo $data->id_wilayah ?>"><?php echo $data->kecamatan ?></option>
					    		<?php } ?>
					    	</select>
					    </div>
					</div>	
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Jenis Kejahatan</label>
					    <div class="col-sm-9">
					    	<select name="id_jenis" class="form-control jenis" required="">
					    		<option value="" selected="">Pilih</option>
					    		<?php foreach ($jenis as $data) { ?>
					    			<option value="<?php echo $data->id_jenis ?>"><?php echo $data->jenis_kejahatan ?></option>
					    		<?php } ?>
					    	</select>
					    </div>
					</div>	
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Tanggal</label>
					    <div class="col-sm-9">
					      <input type="date" class="form-control" name="date" placeholder="Tanggal">
					    </div>
					</div>	
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Uraian</label>
					    <div class="col-sm-9">
					    	<textarea name="uraian" class="form-control" placeholder="Uraian Kejadian"></textarea>
					    </div>
					</div>	
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Tersangka</label>
					    <div class="col-sm-9">
					    	<input type="text" name="tersangka" class="form-control" placeholder="Tersangka">
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
		$('.modal-title').text('Tambah Data Kejadian Kejahatan');
		$('#modal-id').modal('show');
	}

	function save() {
	 	var url;      
      	if(save_method == 'add'){
          url = "<?php echo base_url('kejadian/save')?>";          
      	}else{          
          url = "<?php echo base_url('kejadian/edit/')?>" + gid;         
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
        url : "<?php echo base_url('kejadian/get')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_wilayah"]').val(data.id_wilayah);                                                          
            $('[name="id_jenis"]').val(data.id_jenis);                                                          
            $('[name="date"]').val(data.date);                                                          
            $('[name="uraian"]').val(data.uraian);                                                          
            $('[name="tersangka"]').val(data.tersangka);                                                          
            $('.wilayah').trigger('change');  
            $('.jenis').trigger('change');  
            $('.modal-title').text('Edit Data Kejadian Kejahatan'); // Set title to Bootstrap modal title
            $('#modal-id').modal('show'); // show bootstrap modal when complete loaded

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
      });
    }    

</script>