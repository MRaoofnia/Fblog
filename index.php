<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css">
	<link rel="stylesheet" type="text/css" href="css/theme.css">
	<title>

		<?php
			require("config.php");
			// $servername = "localhost:81";
			// $username = "mraoofnia";
			// $password = "mraoofnia";

			$connection=null;

			try{
				$pdo=Database::connect();
			    // set the PDO error mode to exception
			    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			    $connection=$pdo;
			    $blog=null;
			    $sql="SELECT * FROM settings WHERE id=1";
			    	foreach ($pdo->query($sql) as $title) {
			    		echo $title['blog_title'];
			    		$blog=$title;
			    	}
				}
			    catch(PDOException $e)
			    {

			    	die("err");
			    }


		?> 
	</title>
</head>
<body>
<header>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><?=$blog['blog_title']?></a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="callme.html">تماس با ما</a></li> 
      <li><a href="aboutus.HTML">درباره ما</a></li> 
      <li><a href="new-post.php">افزودن پست</a></li>
    </ul>
  </div>
</nav>
</header>
<section>
	<div class="row">
		<div class="col-lg-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4>مشخصات وبلاگ</h4>
				</div>
				<div class="panel-body">
					<p><?=$blog['description']?></p>
				</div>
			</div>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4>دسته بندی ها</h4>
				</div>
				<div class="panel-body">
					<?php 
						$sql_cats="SELECT * FROM categories LIMIT 7";
						foreach ($pdo->query($sql_cats) as $cat) {
							echo "<a href='?cat=";
							echo $cat['id'];
							echo "'>";
							echo $cat['title'];
							echo "</a><br>";
						}
					 ?>
				</div>
			</div>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4>برچسب های وبلاگ</h4>
				</div>
				<div class="panel-body">
					<?php 
						$sql_tags="SELECT * FROM tags LIMIT 7";
						foreach ($pdo->query($sql_tags) as $tag) {
							echo "<a href='?tag=";
							echo $tag['id'];
							echo "'>";
							echo $tag['title'];
							echo "</a><br>";
						}
					 ?>
				</div>
			</div>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4>پیوند ها</h4>
				</div>
				<div class="panel-body">
					<?php 
						$sql_links="SELECT * FROM links LIMIT 7";
						foreach ($pdo->query($sql_links) as $link) {
							echo "<a href='";
							echo $link['address'];
							echo "'>";
							echo $link['display_name'];
							echo "</a><br>";
						}
					 ?>
				</div>
			</div>
		</div>
		<div class="col-lg-8">
			<?php

			if(isset($_GET['id'])){
				$sql_posts="SELECT * FROM posts WHERE active=true AND id=".$_GET['id'];	
			}else if(isset($_GET['cat'])){
				$sql_posts="SELECT * FROM posts INNER JOIN category_relationship ON posts.id=category_relationship.post_id WHERE posts.active=true AND category_relationship.category_id=".$_GET['cat'];
			}else if(isset($_GET['tag'])){
				$sql_posts="SELECT * FROM posts INNER JOIN tag_relationship ON posts.id=tag_relationship.post_id WHERE posts.active=true AND tag_relationship.tag_id=".$_GET['tag'];
			}else{
				$sql_posts="SELECT * FROM posts WHERE active=true";
			}
				
				foreach ($pdo->query($sql_posts) as $post) {
					?>
					<div class="panel" >
				<div class="panel-heading">
					<h4><?=$post['title']?><small style="float:left;"> <?=$post['date']?> </small></h4>
				</div>
				<div class="panel-body">
					<p><?=$post['content']?></p>
				</div>
				<div class="panel-footer">
					<?php 
						$sql_comments="SELECT * FROM comments WHERE post_id=".$post['id'];
						foreach ($pdo->query($sql_comments) as $comment) {
							?>
							<div class="well well-sm">
								<?=$comment['content']?>
							</div>
							<?php
						}
					 ?>
				</div>
			</div>
			<?php 
				}
				Database::disconnect();
			 ?>
		</div>
	</div>
</section>

</body>
</html>
