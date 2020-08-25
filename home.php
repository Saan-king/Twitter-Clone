<?php
session_Start();
require_once('dbconnect.php');
if(!isset($_SESSION['user']))
{
	header("Location: index.php");	
}
if(!isset($_GET['id']))
{
  header('Location: index.php');
}

$userData=$db->users->findOne(array('_id'=>$_SESSION['user']));
$profile_id=$_GET['id'];

$profileData=$db->users->findOne(array('_id'=>new MongoDB\BSON\ObjectID("$profile_id")));

function get_Recent_Tweets($db)
{
  $id=$_GET['id'];
  $result=$db->tweets->find(array('authorId'=>new MongoDB\BSON\ObjectID("$id")));
  $recent_tweets=;iterator_to_array($result);
  return $recent_tweets
}

function get_recent_tweets($db)
{
$result=$db->following->find(array('follower'=>$_SESSION['user']));
$result=iterator_to_array($result);
$users_following=array();
foreach ($result as $entry)
{
$users_following[]= $entry['user'];
}
$result=$db->tweets->find(array['authorId'=>array('$in'=>$users_following)));
  $recent_tweets=;iterator_to_array($result);
  return $recent_tweets;


?>
<html>
<head>
<title> Twitter Clone </title>
</head>
<body>
<?php include('header.php'); ?>
<form method="post" action="create_tweet.php">
<fieldset>
<label for="tweet">What's happening?</label></br>
<textarea name="body" rows="4" cols="50"></textarea><br>
<input type="submit" value="Tweet"/>
</fieldset>
</form>
<div>
<p><b>Tweet's from the people you are following</b></p>
<?php
$recent_tweets=get_recent_tweets($db);
foreach($recent_tweets as $tweet)
{
echo '<p><a href="profile.php>id='.'">'.$tweet['authorID'].'">'.$tweet['authorName'].'</a></p>';
echo '<p>'.$tweet['body'].'</p>';
echo '<p>'.$tweet['created'].'</p>';
echo '<hr>';
}
?>
</div>
</body>
</html>