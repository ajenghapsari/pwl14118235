<html>
<head>
	<title></title>
</head>
<body>
<?php include ("menu.php");?>
<h1>Data Siswa</h1>
Hasil = <?php echo $hasil; ?>
<a href="<?php echo site_url("siswa/add"); ?>">Add Siswa</a>
<table border="1">
<tr>
<td>nis</td>
<td>nama</td>
<td>alamat</td>
<td>lahir</td>
<td>nilai</td>
<td>foto</td>
<td>jk</td>
<td>pendidikan</td>
<td>status</td>
<td>kode</td>
<td>judul</td>
</tr>
<?php 
foreach ($tabelsiswa as $baris){
 ?>
<tr>
<td> <?php echo $baris->nis; ?>&nbsp;</td>
<td> <?php echo $baris->nama; ?>&nbsp;</td>
<td> <?php echo $baris->alamat; ?>&nbsp;</td>
<td> <?php echo $baris->lahir; ?>&nbsp;</td>
<td> <?php echo $baris->nilai; ?>&nbsp;</td>
<td> <?php echo $baris->foto; ?>&nbsp;</td>
<td> <?php echo $baris->jk; ?>&nbsp;</td>
<td> <?php echo $baris->pendidikan; ?>&nbsp;</td>
<td> <?php echo $baris->status; ?>&nbsp;</td>
<td> <?php echo $baris->kode; ?>&nbsp;</td>
<td> <?php echo $baris->judul; ?>&nbsp;</td>
<td> <img src="<?php echo base_url(); ?>uploads/<?php echo $baris->foto; ?>" width="100"> </td>
<td><a href="<?php echo site_url("siswa/edit/".$baris->nis); ?>">Edit</a> &nbsp; <a href="<?php echo site_url("siswa/del/".$baris->nis);  ?>">Del</a></td>
</tr>
<?php 
}
 ?>
</table>
</body>
</html>