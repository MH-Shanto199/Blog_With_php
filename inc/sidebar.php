<div class="sidebar clear">
    <div class="samesidebar clear">
        <h2>Categories</h2>
            <ul>
                <?php
                    $query    = "SELECT * FROM tbl_category ";
                    $Category = $db->select($query);
                    if ($Category) {
                        while ($result = $Category->fetch_assoc()) {
                ?>
                <li><a href="posts.php?category=<?php echo $result['id'];?>"><?php echo $result['name']; ?></a></li>
                <?php } } else { ?>
                <li>NO Category Created</li>
                <?php }?>
            </ul>
    </div>
    
    <div class="samesidebar clear">
        <h2>Latest articles</h2>
        <?php 
            $query = "SELECT * FROM tbl_post LIMIT 4";
            $post  = $db->select($query);
            if ($post) {
                while ($result = $post->fetch_assoc()) {
        ?>
        <div class="popular clear">
            <h3><a href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title'];?></a></h3>
            <a href="post.php?id=<?php echo $result['id'];?>"><img src="admin/upload/<?php echo $result['image']; ?>" alt="post image"/></a>
            <?php echo $fm->short($result['body'], 220); ?>
        </div>
	    <?php } } else { header("location:404.php"); }?>
    </div>
</div>