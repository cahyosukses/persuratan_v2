<?php 
?>

<table width="100%">
	<tr>
	<td width="15%">
		<img src="<?php echo base_url()."upload/kop_surat_logo/".$d->logo?>" style="width: 96%; height: 100px">
	</td>
	<td style="text-align: center">
	<?php echo "<h2>".$d->nama_lbg."</h2>"; ?>
	<?php echo "Alamat : ".$d->alamat.". Kd. Pos : ".$d->kdpos; ?><br>
	<?php echo "No. Telp : ".$d->notelp.". Fax : ".$d->nofax; ?><br>
	<?php echo "Website : ".$d->site.". Email : ".$d->email; ?><br>
	</td>
	</tr>
	<tr>
	<td colspan="2"><hr style="border: solid 1px #000"></td>
	</tr>
</table>
