<div class="container">

	
	<form method="post" action="">
		<div class="row mb-3">
			<div class="col-sm-12"><h4>Cari</h4></div>
			<div class="col-sm-3">
				<div class="form-group">
					<select name="selectProvinsi" id="selectProvinsi" class="form-control">
						<option></option>
						
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
				<div class="col-sm-4" >
					<button id="search" class="btn btn-warning">Cari</button>
				</div>
			</div>
		</form>
	</div>