<?php
	include_once 'inc/header.php';
?>

<?php 
	if (!isset($_GET['id']) || $_GET['id'] == NULL) {
		header("location:404.php");
	}else {
		$id = $_GET['id'];
	}
?>
<div class="contentsection contemplete clear">
<div class="maincontent clear">
	<div class="about">
		<?php
			$query  = "SELECT * FROM tbl_post WHERE id=$id";
			$post = $db->select($query);
			if ($post) {
				while ($result = $post->fetch_assoc()) {
		?>
		<h2><?php echo $result['title']; ?></h2>
		<h4><?php echo $fm->FormatDate($result['date']); ?>, By <a href="#"><?php echo $result['author']; ?></a></h4>
		<img src="admin/upload/<?php echo $result['image']; ?>" alt="post image"/>
		<?php echo $result['body']; ?>
		<div class="relatedpost clear">
			<h2>Related articles</h2>
			<?php
				$catid 	  = $result['cat'];
				$catQuery = "SELECT * FROM tbl_post WHERE cat='$catid' LIMIT 6";
				$catPost  = $db->select($catQuery);
				$postid   = $result['id'];
				if ($catPost) {
					while ($catResult = $catPost->fetch_assoc()) {
			?>
			<a href="post.php?id=<?php echo $catResult['id']; ?>"><img src="admin/upload/<?php echo $catResult['image']; ?>" alt="post image"/></a>
			<?php  } } else { echo "No Related Post Available"; }?>
		</div>
		<?php } } else { header("location:404.php"); }?>
	</div>
</div>
<?php include_once 'inc/sidebar.php'; ?>
<?php include_once 'inc/footer.php'; ?>