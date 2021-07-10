<?php
    include_once 'inc/header.php';
    include_once 'inc/sidebar.php';
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Post</h2>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $title     = $fm->validation($_POST['title']);
                $tags      = $fm->validation($_POST['tags']);
                $author    = $fm->validation($_POST['author']);
                $category  = $fm->validation($_POST['category']);
                $body      = $fm->validation($_POST['body']);

                // image
                $permited  = array('jpg', 'jpeg', 'png', 'gif');
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_temp = $_FILES['image']['tmp_name'];
            
                $div       = explode('.', $file_name);
                $file_ext  = strtolower(end($div));
                $unq_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                $image     = "upload/".$unq_image;
                // image

                // validation
                if ($title = "" || $tags = "" || $author = "" || $category = "" || $body = "") {
                    echo "<span class='erorr'>Fild must not be empty...!</span>";
                            // image validation start........
                }elseif ($file_size >1048567) {
                      echo "<span class='error'>Image Size should be less then 1MB!</span>";
                } elseif (in_array($file_ext, $permited) === false) {
                      echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
                } else{
                      move_uploaded_file($file_temp, $image);
                      $query = "INSERT INTO tbl_post( cat, title, body, image, author, tags) VALUES('$category','$title','$body','$image','$author','$tags' )";
                      $inserted_rows = $db->insert($query);
                    if ($inserted_rows) {
                        echo "<span class='success'>Data Inserted Successfully.</span>";
                    }else {
                        echo "<span class='error'>There is a problame to Inserted Data !</span>";
                    }
                }
                            // image validation end.......
                // validation
            }
        ?>
        <div class="block">               
            <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
                
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter Post Title..." class="medium" name="title" />
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Tags</label>
                    </td>
                    <td>
                        <input type="text"placeholder="Enter Tags..." class="medium" name="tags" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Author</label>
                    </td>
                    <td>
                        <input type="text"placeholder="Enter Author Name..." class="medium"  name="author" />
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="category">
                            <option>Select Category</option>
                            <?php
                                $query  = "SELECT * FROM tbl_category";
                                $getCat = $db->select($query);
                                if ($getCat) {
                                    while ($result = $getCat->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $result['id']?>"><?php echo $result['name']?></option>
                            <?php } }?>
                        </select>
                    </td>
                </tr>
            
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input type="file" name="image"/>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body"></textarea>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include_once 'inc/footer.php'; ?>

