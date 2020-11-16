<div class="container">
		
		<form action="" method="post">

			<div class="form-group">
    			<label for="provinsi">Provinsi</label>
    			<select name="id_provinsi" id="provinsi" class="form-control">
    				<option value="<?php echo $kabupaten['id_provinsi'] ?>"><?php echo $kabupaten['nama_provinsi'] ?></option>
    				<?php foreach ($provinsi as $key => $value) { ?>
					<option value="<?php echo $value['id_provinsi'] ?>">
					<?php echo $value['nama_provinsi'];?></option>
					<?php } ?>
    			</select>
  			</div>
  			<div class="form-group">
    			<label for="provinsi">Kabupaten</label>
    			<input type="text" class="form-control" placeholder="Masukan Provinsi" name="nama_kabupaten" value="<?php echo $kabupaten['nama_kabupaten'] ?>">
  			</div>
  			<div class="form-group">
    			<label for="provinsi">Jumlah Penduduk</label>
    			<input type="number" class="form-control" placeholder="Jumlah Penduduk" name="jumlah_penduduk" value="<?php echo $kabupaten['jumlah_penduduk'] ?>">
  			</div>


			<button type="submit" class="btn btn-primary" id="submitDaftar">Simpan</button>
			
		</form>

	</div>