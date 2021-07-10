﻿<?php
    include_once 'inc/header.php';
    include_once 'inc/sidebar.php';
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Category</h2>
        <div class="block copyblock"> 
            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $name = $fm->validation($_POST['name']);
                    if (empty($name)) {
                        echo "<span class='erorr'>Field must not be empty..</span>";
                    } else {
                        $query = "INSERT INTO tbl_category( name ) VALUES ('$name')";
                        $catInsert = $db->insert($query);
                        if ($catInsert) {
                            echo "<span class='success'>Category Inserted successfully....!</span>";
                        } else {
                            echo "<span class='erorr'>There is a problem to insert category Data....</span>";
                        }
                    }
                    
                }
            ?>
            <form action="" method="post">
                <table class="form">					
                    <tr>
                        <td>
                            <input type="text" name="name" placeholder="Enter Category Name..." class="medium" />
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php
    include_once 'inc/footer.php';
?>
