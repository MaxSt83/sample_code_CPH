<?php
require_once('db.php');

// C какой статьи будет осуществляться вывод
$startFrom = $_POST['startFrom'];

//echo $startFrom;

$sth = $dbh->prepare("SELECT author, text, date, email FROM comments ORDER BY id DESC LIMIT :limit, 10");
$sth->bindValue('limit', $startFrom);
$sth->execute();
//$array = $sth->fetchAll(PDO::FETCH_ASSOC);

while ($row = $sth->fetch(PDO::FETCH_LAZY)) {
    echo '<div class="author_name"><span class="title">Имя:</span> '.$row->author.'</div> 
			<div class="comment_email"><span class="title">E-mail:</span> <span class="email">'.$row->email.'</span></div>
			<div class="comment_text"><span class="title">Текст:</span> '.$row->text.'</div>';
}
//print_r($array);






?>
