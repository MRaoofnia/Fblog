
<!DOCTYPE html>
<?php require("config.php"); ?>
<html>
<head>

	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css">
	<title>افزودن پست</title>
</head>
<style type="text/css">
	body{
		background-color: #222222;
	}
	.content{
		margin-top: 150px;
	}
	panel-body{
		padding:50px;
	}

</style>
<body>
<?php 
	
			try{
				$pdo=Database::connect();
			    // set the PDO error mode to exception
			    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			    $connection=$pdo;
			    $blog=null;
			    $sql="SELECT * FROM settings WHERE id=1";
			    	foreach ($pdo->query($sql) as $title) {
			    		$blog=$title;
			    	}
				}
			    catch(PDOException $e)
			    {

			    	die("err");
			    }

 ?>
<header>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><?=$blog['blog_title']?></a>
    </div>
    <ul class="nav navbar-nav">
      <li ><a href="../fblog/">Home</a></li>
      <li><a href="callme.html">تماس با ما</a></li> 
      <li><a href="aboutus.html">درباره ما</a></li> 
      <li class="active"><a href="new-post.php">افزودن پست</a></li>
    </ul>
  </div>
</nav>
</header>
<section>
<center>
<div class="col-lg-2"></div>
<div class="panel content col-lg-8  panel-primary">
<?php 
	session_start();
	if(isset($_POST['sub2'])&&isset($_POST['user'])&&isset($_POST['pass'])){
		$sql="SELECT * FROM authors WHERE username='".$_POST['user']."'";
		foreach ($pdo->query($sql) as $user) {
			if($user['password']==$_POST['pass'])
				$_SESSION['id']=$user['id'];
		}
	}



	if(isset($_SESSION['id'])){
		if(isset($_POST['sub1'])&&isset($_POST['title'])&&isset($_POST['content'])){
		try{
			$sql="INSERT INTO posts (active,title,content,date,user_id) VALUES (?,?,?,?,?)";
			$q=$pdo->prepare($sql);
			$q->execute(array(1,$_POST['title'],$_POST['content'],date('Y/m/d H:i:s'),$_SESSION['id']));
			/*echo '<div class="alert alert-success">
					  <strong>تبریک!</strong> پست شما با موفقیت ثبت شد.
					</div>';*/
		}catch(PDOException $e){
			echo '<div class="alert alert-danger">
					  <strong>خطا!</strong> مشکلی در برقراری ارتباط با سرور پیش آمده.
				</div>';	
		}
	}
 ?>
 <div class="panel-heading">
 	پست جدید
 </div>
 <div class="panel-body">
<form method="POST" action="#" class="form-group">
	<input name="title" type="text" placeholder="title"></input><br>
	<textarea name="content" placeholder="post content here...."></textarea><br>
	<input class="btn btn-success" name="sub1" type="submit" value="نتشار پست"></input>
</form>
</div>
<?php 
}else {
 ?>

 <div class="panel-heading">
 	پست جدید
 </div>
 <div class="panel-body">
 <form  method="POST" action="#" class="formgroup">
 	<input name="user" type="text" placeholder="username"></input><br>
 	<input name="pass" type="password" placeholder="password"></input><br>
 	<input class="btn btn-primary" name="sub2" type="submit" value="log in"></input>
 </form>
</div>
<?php }
Database::disconnect(); ?>
</div>
</center>
</section>
</body>
</html>