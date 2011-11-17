<?php			
	$pj = $_POST["pj"];	
?>

<script LANGUAGE="JavaScript">
	var pjnum = <?php echo "$pj";?>;
				
	//conseguir imagen
	var pjsrc = "images/0"+pjnum+".png"; 		
	document.personaje.src= pjsrc;

</script>

