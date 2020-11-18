<?php if($this->session->flashdata('pesan')): ?>	
	<?php echo $this->session->flashdata('pesan'); ?>
<?php endif ?>

<div class="container">

	<div class="mt-2 mb-2">
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#form" onclick="submit('tambah');">Tambah Provinsi</button>
	</div>

	<table class="table" id="tableprovinsi">
		<thead class="thead-default">
			<tr>
				<th>No</th>
				<th>Provinsi</th>
				<th>Jumlah Penduduk</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody id="target">
			
		</tbody>
	</table>
</div>

<!-- form tambah data -->
<div class="modal" id="form" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title">Form Tambah Provinsi</h2>
				<button type="button" class="close" data-dismiss="modal" id="clear">&times;</button>
			</div>
			<div class="modal-body">
				<form action="" method="post">
					<div class="form-group">
						<label for="provinsi">Provinsi</label>
						<font color="red"><p id="pesan"></p></font><font color="red"><p id="pesan2"></p></font><font color="red"><p id="pesan3"></p></font>
						<input type="text" class="form-control" placeholder="Masukan Provinsi" name="nama_provinsi">
						<input type="hidden" name="id_provinsi" value="">
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



<script type="text/javascript">

	ambil();
	function ambil()
	{
		$.ajax({
			type: 'ajax',
			url: '<?php echo base_url("index/ambil"); ?>',
			async: false,
			dataType: 'json',
			success: function(data){

				var baris;
				for (var i = 0 ; i < data.length; i++) {
					if (data[i].jumlah_penduduk == null) {
						data[i].jumlah_penduduk = 0;
					}
					baris += '<tr>'+
					'<td> '+ (i+1) +' </td>' +
					'<td> '+ data[i].nama_provinsi +' </td>' +
					'<td> '+ data[i].jumlah_penduduk +' </td>' +
					'<td> '+ '<a href="#form" data-toggle="modal" class="btn btn-warning mr-1" onclick="submit('+data[i].id_provinsi+');" >Ubah</a>' + '<a href="" class="btn btn-danger" onclick="hapus('+data[i].id_provinsi+');">Hapus</a>' +' </td>' +
					'</tr>';
				}
				$('#target').html(baris);
			}
		});
	}

	function tambahdata()
	{
		var nama_provinsi = $("[name='nama_provinsi']").val();

		$.ajax({
			type:'POST',
			data: 'nama_provinsi='+nama_provinsi,
			url:'<?php echo base_url("index/tambah"); ?>',
			dataType: 'json',
			success: function(hasil)
			{
				$('#pesan').html(hasil.pesan);

				if(hasil.pesan == '')
				{
					$("#form").modal('hide');
					ambil();
					$("[name='nama_provinsi']").val('');
				}
			}
		});
	}

	function submit(x)
	{
		if(x=='tambah')
		{
			$('#btn-tambah').show();
			$('#btn-ubah').hide();
		}
		else
		{
			$('#btn-tambah').hide();
			$('#btn-ubah').show();

			$.ajax({
				type: 'POST',
				data: 'id_provinsi='+x,
				url: '<?php echo base_url("index/ambilId") ?>',
				dataType: 'json',
				success: function(hasil)
				{
					$('[name="nama_provinsi"]').val(hasil.nama_provinsi);
					$('[name="id_provinsi"]').val(hasil.id_provinsi);

					$(document).ready(function(){

						$("#clear").click(function(){
							$("#form").modal('hide');
							ambil();
							$("[name='nama_provinsi']").val('');
						})
					});

					$(document).ready(function(){

						$("#clear2").click(function(){
							$("#form").modal('hide');
							ambil();
							$("[name='nama_provinsi']").val('');
						})
					});
					
					
				}
			})

		}
	}

	function ubah()
	{
		var nama_provinsi = $("[name='nama_provinsi']").val();
		var id_provinsi = $("[name='id_provinsi']").val();

		$.ajax({
			type: 'POST',
			data: 'id_provinsi='+id_provinsi+'&nama_provinsi='+nama_provinsi,
			url: '<?php echo base_url("index/ubah") ?>',
			dataType: 'json',
			success: function(hasil)
			{
				$('#pesan').html(hasil.pesan);

				if(hasil.pesan == '')
				{
					$("#form").modal('hide');
					ambil();
					$("[name='nama_provinsi']").val('');
					
				}
				

			}

		});
	}

	function hapus(id)
	{
		var tanya = confirm('apakah anda yakin akan menghapus data?');

		if (tanya) 
		{
			$.ajax({
				type: 'POST',
				data: 'id_provinsi='+id,
				url:'<?php echo base_url("index/hapus"); ?>',
				success: function()
				{
					ambil();
					
				}
			});
		}
		
		
	}


</script>