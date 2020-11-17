

<div class="container">
	<div class="mt-2 mb-2">
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#form" onclick="submit('tambah');">Tambah Kabupaten</button>
	</div>
</div>

<div class="container">	
	<form method="post" action="" id="searching">
		<div class="row mb-3">
			<div class="col-sm-12"><h4>Cari</h4></div>
			<div class="col-sm-3">
				<div class="form-group">
					<select name="selectProvinsi" id="selectProvinsi" class="form-control">
						<option></option>
						<option value="semua">Semua</option>
						<?php foreach ($provinsi as $key => $value) {
							?>
							<option value="<?php echo $value['id_provinsi'] ?>">
								<?php echo $value['nama_provinsi'];?></option>
							<?php } ?>


						</select>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<select name="selectKabupaten" id="selectKabupaten" class="form-control">
							<option></option>
						</select>
					</div>
				</div>
			</div>
		</form>
	</div>

	<div class="container">
		<table class="table table-striped table-bordered" style="width:100%" id="tablekabupaten">
			<thead>
				<tr>
					<td>No</td>
					<td>Provinsi</td>
					<td>Kabupaten</td>
					<td>Jumlah Penduduk</td>
					<td>Aksi</td>
				</tr>
			</thead>
			<tbody id="target">
				
			</tbody>
		</table>

	</div>

	<!-- form tambah -->
	<div class="modal" id="form" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="modal-title">Formulir Tambah Kabupaten</h2>
					<button type="button" class="close" data-dismiss="modal" id="clear">&times;</button>
				</div>
				<div class="modal-body">
					<font color="red"><p id="pesan"></p></font>
					<form action="" method="post">
						<div class="form-group">
							<label for="provinsi">Provinsi</label>
							<select name="id_provinsi" id="provinsi" class="form-control">								
							</select>
						</div>
						<div class="form-group">
							<label for="provinsi">Kabupaten</label>
							<input type="text" class="form-control" placeholder="Masukan Provinsi" name="nama_kabupaten">
							<input type="hidden" name="id_kabupaten" value="">
						</div>
						<div class="form-group">
							<label for="provinsi">Jumlah Penduduk</label>
							<input type="number" class="form-control" placeholder="Jumlah Penduduk" name="jumlah_penduduk">
						</div>
						<button type="button" class="btn btn-primary" onclick="tambahdata();" id="btn-tambah">Tambah</button>
						<button type="button" class="btn btn-primary" onclick="ubah();" id="btn-ubah">Ubah</button>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal" id="clear2">close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- end formulir -->


	<script type="text/javascript">

		ambil();
		function ambil()
		{
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url('kabupaten/ambil'); ?>',
				async: false,
				dataType: 'json',
				success: function(data)
				{
					var baris;
					data=data.kabupaten;
					for(var i=0; i<data.length; i++)
					{
						baris += '<tr>'+
						'<td>'+ (i+1) +'</td>' +
						'<td>'+ data[i].nama_provinsi +'</td>' +
						'<td>'+ data[i].nama_kabupaten +'</td>' +
						'<td>'+ data[i].jumlah_penduduk +'</td>' +
						'<td> <a href="#form" class="btn btn-warning" data-toggle="modal" onclick="submit('+ data[i].id_kabupaten +')">Ubah</a> <a href="" class="btn btn-danger" onclick="hapus('+data[i].id_kabupaten+')">Hapus</a> </td>' +
						'</tr>';
					}
					$('#target').html(baris);
				}

			})
		}

		function tambahdata()
		{
			var id_provinsi = $("[name='id_provinsi']").val();
			var nama_kabupaten = $("[name='nama_kabupaten']").val();
			var jumlah_penduduk = $("[name='jumlah_penduduk']").val();

			$.ajax({
				type: 'POST',
				data: 'id_provinsi='+id_provinsi+'&nama_kabupaten='+nama_kabupaten+'&jumlah_penduduk='+jumlah_penduduk,
				url: '<?php echo base_url('kabupaten/tambah'); ?>', 
				dataType: 'json',
				success: function(hasil)
				{
					$("#pesan").html(hasil.pesan);

					if(hasil.pesan=='')
					{
						$("#form").modal('hide');
						ambil();
						$("[name='id_provinsi']").val('');
						$("[name='nama_kabupaten']").val('');
						$("[name='jumlah_penduduk']").val('');
					}
				}
			});

		}

		function submit(x)
		{
			if(x=='tambah')
			{
				$("#btn-tambah").show();
				$("#btn-ubah").hide();

				$.ajax({
					type:'POST',
					url: '<?php echo base_url("kabupaten/ambil") ?>',
					dataType: 'json',
					success: function(data)
					{

						var opsi='<option disabled selected>Pilih</option>';
						data=data.provinsi;

						for(var i=0; i<data.length; i++)
						{

							opsi += '<option value="'+data[i].id_provinsi+'">'+data[i].nama_provinsi+'</option>';
						}

						$("#provinsi").html(opsi);
					}
				});
			}
			else
			{
				$("#btn-tambah").hide();
				$("#btn-ubah").show();

				$.ajax({
					type: 'POST',
					data: 'id_kabupaten='+x,
					url: '<?php echo base_url("kabupaten/ambilById") ?>',
					dataType: 'json',
					success: function(data)
					{
						kabupaten=data.kabupaten;
						data=data.provinsi;
						var opsi;
						for(var i=0; i<data.length; i++)
						{
							if(data[i].id_provinsi==kabupaten.id_provinsi)
							{
								opsi += '<option value="'+data[i].id_provinsi+'" selected>'+data[i].nama_provinsi+'</option>';
							}
							else
							{
								opsi += '<option value="'+data[i].id_provinsi+'">'+data[i].nama_provinsi+'</option>';
							}
						}

						$("#provinsi").html(opsi);


						$('[name="id_kabupaten"]').val(kabupaten[0].id_kabupaten);
						$('[name="nama_kabupaten"]').val(kabupaten[0].nama_kabupaten);
						$('[name="id_provinsi"]').val(kabupaten[0].id_provinsi);
						$('[name="jumlah_penduduk"]').val(kabupaten[0].jumlah_penduduk);

						$(document).ready(function(){

							$("#clear").click(function(){
								$("#form").modal('hide');
								ambil();
								$('[name="nama_kabupaten"]').val('');
								$('[name="id_provinsi"]').val('');
								$('[name="jumlah_penduduk"]').val('');
							})
						});

						$(document).ready(function(){

							$("#clear2").click(function(){
								$("#form").modal('hide');
								ambil();
								$('[name="nama_kabupaten"]').val('');
								$('[name="id_provinsi"]').val('');
								$('[name="jumlah_penduduk"]').val('');
							})
						});

					}
				})

			}
		}

		function ubah()
		{
			var id_kabupaten = $("[name='id_kabupaten']").val(); 
			var id_provinsi = $("[name='id_provinsi']").val();
			var nama_kabupaten = $("[name='nama_kabupaten']").val();
			var jumlah_penduduk = $("[name='jumlah_penduduk']").val();

			$.ajax({
				type: 'POST',
				data: 'id_kabupaten='+id_kabupaten+'&id_provinsi='+id_provinsi+'&nama_kabupaten='+nama_kabupaten+'&jumlah_penduduk='+jumlah_penduduk,
				url: '<?php echo base_url('kabupaten/ubah'); ?>', 
				dataType: 'json',
				success: function(hasil)
				{
					$("#pesan").html(hasil.pesan);

					if(hasil.pesan == '')
					{
						$("#form").modal('hide');
						ambil();

					}
				}
			});
		}

		function hapus(id)
		{
			var konfirmasi = confirm('apakah yakin ingin menghapus?');

			if (konfirmasi)
			{
				$.ajax({
					type: 'POST',
					data: 'id_kabupaten='+id,
					url: '<?php echo base_url('kabupaten/hapus'); ?>',
					dataType: 'json',
					success: function()
					{
						ambil();
					}
				});
			}


		}



	</script>