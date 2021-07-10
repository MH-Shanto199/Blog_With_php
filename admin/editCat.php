<?php
    include_once 'inc/header.php';
    include_once 'inc/sidebar.php';
?>
<?php
    if (!isset($_GET['catId']) || $_GET['catId'] == NULL) {
        echo "<script>window.location = 'catlist.php'</script>";
    } else {
        $id = $_GET['catId'];
    }
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Category</h2>
        <div class="block copyblock"> 
            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $name = $fm->validation($_POST['name']);
                    if (empty($name)) {
                        echo "<span class='erorr'>Field must not be empty..</span>";
                    } else {
                        $query = "  UPDATE tbl_category 
                                    SET
                                    name = '$name'
                                    WHERE id = '$id' ";
                        $updated_Row = $db->update($query);
                        if ($updated_Row) {
                            echo "<span class='success'>Category Updated successfully....!</span>";
                        } else {
                            echo "<span class='erorr'>There is a problem to Update category Data....</span>";
                        }
                    }
                    
                }
            ?>
            <form action="" method="post">
                <?php
                    $query = "SELECT * FROM tbl_category WHERE id='$id'";
                    $category = $db->select($query);
                    if ($category) {
                        while ($result = $category->fetch_assoc()) {
                ?>
                <table class="form">					
                    <tr>
                        <td>
                            <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
                <?php } } else { ?>
                    <span class="erorr">Invalid Category ID!..</span>
                <?php }?>
            </form>
        </div>
    </div>
</div>
<?php
    include_once 'inc/footer.php';
?>
