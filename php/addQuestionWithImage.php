<?php
	include 'configEzarri.php';
	if($_FILES['imgInp']['error']){
		$irudia = 0;
	}else{
		$irudia = addslashes(file_get_contents($_FILES['imgInp']['tmp_name']));
	}
	$sql = "INSERT INTO questions(email, galdera, zuzena, okerra1, okerra2, okerra3, zail, arloa, imgInp) 
			VALUES ('$_POST[email]', '$_POST[galdera]', '$_POST[zuzena]', '$_POST[okerra1]', '$_POST[okerra2]',
					'$_POST[okerra3]', '$_POST[zail]', '$_POST[arloa]', '$irudia')";
	$ema = mysqli_query($link, $sql);
	if(!$ema){
		echo 'Errorea query-a gauzatzerakoan: ' . mysqli_error($link);
		echo "<p><a href='../addQuestion.html'>Beste galdera bat txerta ezazu!</a></p>";
		die();
	}else{
		echo "Erregistroa gehitu da!";
		echo "<p><a href='./showQuestionsWithImages.php'>Galdera guztiak ikusi</a></p>";
	}
	
?>