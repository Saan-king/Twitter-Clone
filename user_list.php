<?php
session_start();
require_once('dbconnect.php');

if(!isset($_SESSION['user']))
{
  header('Location: index.php');
}
$userData=$db->users->findOne(array('_id'=>$_SESSION['user']));
function get_user_list($db)
{
$result=$db->users->find();
$users-iterator_to_array($result);
return $users;
}
?>

<html>
<head>
<title>Twitter Clone</twitter>
</head>
<body>
<?php inclue('header.php');?>
<div>
<p><b>List of users</b></p>
<?php
$user_list=get_user_list($db);
foreach ($user_list as $user)
{
  echoo '<span>' .$user['username'] .'</span>';
  echo'[<a href="profile.php?id='.$user['_id'].'">Visit Profile</a>]';
  echo '[<a href="follow.php?id='.$user['_id'].'"Follow</a>]';
  echo '<hr>';
}
</div>
</body>
</html>
