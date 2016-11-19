<html>
<head>
	<title></title>
</head>
<body>
	<?php include ("menu.php");?>
<h1>Data Pelatihan</h1>
<form method="post" action="<?php echo site_url("pelatihan/index"); ?>">
	<table>
		<tr>
		<td>Kata kunci</td>
		<td><input type="text" name="keyword"></td>
		<td><input type="submit" value="cari"></td>
		</tr>
	</table>
</form>
<a href="<?php echo site_url("pelatihan/add"); ?>">Add Pelatihan</a>
<table border="1">

<tr>
<td>kode</td>
<td>judul</td>
<td>materi</td>
<td>mulai</td>
<td>harga</td>
<td>foto</td>
</tr>
<?php 
foreach ($tabelpelatihan as $baris){
 ?>
<tr>
<td> <?php echo $baris->kode; ?> </td>
<td> <?php echo $baris->judul; ?> </td>
<td> <?php echo $baris->materi; ?> </td>
<td> <?php echo $baris->mulai; ?> </td>
<td> <?php echo $baris->harga; ?></td>
<td><img src="<?php echo base_url(); ?>uploads/<?php echo $baris->foto; ?>" width="100"> </td><?php echo $baris->foto; ?> </td>
<td><a href="<?php echo site_url("pelatihan/edit/".$baris->kode); ?>">Edit</a> &nbsp; <a href="<?php echo site_url("pelatihan/del/".$baris->kode);  ?>">Del</a></td>
</tr>
<?php 
}
 ?>
</table>
</body>
</html>