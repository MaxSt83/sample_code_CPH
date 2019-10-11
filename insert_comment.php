<?php
require_once('db.php');

//insert new comments

$user_name=$_POST['user_name'];
$comment_text=$_POST['comment_text'];
$email=$_POST['email'];

$result=mysql_query("INSERT into comments (author, text, email) values (':user_name', ':comment_text', ':email')");

$sth = $dbh->prepare("INSERT into comments (author, text, email) values ('$user_name', '$comment_text', '$email')");
$sth->bindValue('user_name', $user_name);
$sth->bindValue('comment_text', $comment_text);
$sth->bindValue('email', $email);
$sth->execute();


?>
