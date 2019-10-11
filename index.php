<?php
header("Content-Type: text/html; charset=utf-8");
require_once('db.php');
?>
<!DOCTYPE html>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>


</head>
<body>
<div class="text" style="overflow: auto; background-color: #e8e8e8; height: 600px;">

	<div class="header">
		Оставить комментарий
	</div>

	<div class="comment">
		Ваше имя
	</div>

	<input class="input_text" name="user_name" id="user_name" type="text">
	<div class="comment">
		Ваша почта
	</div>

	<input class="input_text" name="email" id="email" type="text">

	<div class="comment">
		Ваш комментарий
	</div>

	<textarea class="input_textarea" name="comment_text" id="comment_text">
	</textarea>

	<input type="hidden" name="form_sent" value="1">

	<div class="input_button">
		<button onclick="insert_comment();">
			Отправить
		</button>
	</div>




	


	<div id="articles" style="">

		<?php
		

		//show existing comments
		$sth = $dbh->prepare("SELECT author, text, date, email FROM comments ORDER BY id DESC LIMIT 0, 10");
		$sth->execute();
		//$array = $sth->fetchAll(PDO::FETCH_ASSOC);

		while ($row = $sth->fetch(PDO::FETCH_LAZY)) {
			echo '
			<div class="author_name"><span class="title">Имя:</span> '.$row->author.'</div> 
			<div class="comment_email"><span class="title">E-mail:</span> <span class="email">'.$row->email.'</span></div>
			<div class="comment_text"><span class="title">Текст:</span> '.$row->text.'</div>';
		}
		?>
		
	</div>
	
	
	
</div>

</body>
</html>