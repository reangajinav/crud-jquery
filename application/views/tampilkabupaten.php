
<div class="container">
	<div class="mt-2 mb-2">
		<a href="<?php echo base_url('kabupaten/tambah'); ?>" class="btn btn-info">Tambah Kabupaten</a>
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
			<tbody>
				<?php $no=1; ?>
				<?php foreach ($kabupaten as $key => $value) { ?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $value['nama_provinsi'] ?></td>
						<td><?php echo $value['nama_kabupaten'] ?></td>
						<td><?php echo $value['jumlah_penduduk'] ?></td>
						<td>
							<a href="<?php echo base_url("kabupaten/ubah/".$value["id_kabupaten"]); ?>" class="btn btn-info">Ubah</a>
							<a href="<?php echo base_url("kabupaten/hapus/".$value["id_kabupaten"]); ?>" class="btn btn-danger" onclick="return confirm('yakin')">hapus</a>
						</td>
					</tr>
					<?php $no++; } ?>
				</tbody>
			</table>

		</div>