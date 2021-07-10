<?php
	include_once 'inc/header.php';
?>
<?php 
	if (!isset($_GET['search']) || $_GET['search'] == NULL) {
		header("location:404.php");
	}else {
		$search = $_GET['search'];
	}
?>
<div class="contentsection contemplete clear">
<div class="maincontent clear">
    <?php 
        $query = "SELECT * FROM tbl_post WHERE title LIKE '%$search%' OR body LIKE '%$search%' ";
        $post  = $db->select($query);
        if ($post) {
            while ($result = $post->fetch_assoc()) {
    ?>
    <div class="samepost clear">
        <h2><a href="post.php?id=<?php echo $result['id']; ?>"> <?php echo $result['title']; ?> </a></h2>
            <h4><?php echo $fm->FormatDate($result['date']); ?>, By <a href="#"><?php echo $result['author']; ?></a></h4>
            <a href="#"><img src="admin/upload/<?php echo $result['image']; ?>" alt="post image"/></a>
            <?php echo $fm->short($result['body']); ?>
        <div class="readmore clear">
            <a href="post.php?id=<?php echo $result['id']; ?>">Read More</a>
        </div>
    </div>
	<?php } } else { ?>
    <div>your search query not found it</div>
    <?php }  ?>
</div>
<?php include_once 'inc/sidebar.php'; ?>
<?php include_once 'inc/footer.php'; ?>