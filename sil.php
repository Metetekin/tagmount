<?php 
 include ("vendor/baglan.php");
if(isset($_POST)){
	$id=$_POST['id'];

	if($id!=""){

		$sorgu=$db->prepare("UPDATE pointer SET ACTIVE=0 WHERE ID=?");
		$sorgu->bindParam(1,$id,PDO::PARAM_INT);

		$calistir=$sorgu->execute();
		if($calistir){
			echo 'sildim';
		}else{
			echo 'silmedim';
		}

	}else{
		echo "İD Boş Geldi";
	}
}
?>