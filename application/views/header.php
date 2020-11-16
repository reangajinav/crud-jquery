<!DOCTYPE html>
<html>
<head>
	<title>Data</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>


  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="">Dashboard</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="<?= base_url(); ?>">Data Provinsi<span class="sr-only">(current)</span></a>
          </li> 
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo base_url('kabupaten/index'); ?>">Data Kabupaten<span class="sr-only">(current)</span></a>
          </li>    
        </ul>
 <!--        <?php $admin = $this->session->userdata('admin'); ?>
        
        <a href="#" style="color: #000;" class="nav-link">Selamat datang <?php echo $admin["username"] ?></a> 
        <a href="<?php echo base_url('login/logout'); ?>" class="btn btn-danger">Sign Out</a>     -->  

      </div>
    </nav>
  </div>