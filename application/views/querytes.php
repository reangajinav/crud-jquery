<?php 

$query="select * from kabupaten left join provinsi on provinsi.id_provinsi=kabupaten.id_provinsi";

if(isset($_POST['search']))
{
	$s_prov=$_POST['s_provinsi'];
	$query="select * from kabupaten left join provinsi on provinsi.id_provinsi=kabupaten.id_provinsi where kabupaten.id_provinsi like '%$s_prov%' and kabupaten.id_kabupaten like '%$s_kab%' ";
}

$result=mysqli_query($koneksi, $query);

while($data=mysqli_fetch_array($result)) {
	?>

	<?php echo $data['nama_provinsi']; ?>
	<?php echo $data['nama_kabupaten']; ?>
	<?php echo $data['jumlah_penduduk']; ?>

<?php } ?>


?>