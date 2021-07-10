<?php
    include_once 'inc/header.php';
    include_once 'inc/sidebar.php';
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
        <?php
            if (isset($_GET['catId'])) {
                $catId = $_GET['catId'];
                $delQuery = "DELETE FROM tbl_category WHERE id='$catId'";
                $delData = $db->delete($delQuery);
                if ($delQuery) {
                    echo "<span class='success'>Category Delete successfully....!</span>";
                } else {
                    echo "<span class='erorr'>There is a problem to Delete category Data....</span>";
                }
            }
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
            <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query = "SELECT * FROM `tbl_category` ORDER BY id ASC";
                    $category = $db->select($query);
                    if ($category) {
                        $i = 0;
                        while ($result = $category->fetch_assoc()) {
                            $i++;
                ?>
                <tr class="odd gradeX">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $result['name']; ?></td>
                    <td>
                        <a href="editCat.php?catId=<?php echo $result['id'];?>">Edit</a> || 
                        <a onclick="return confirm('Are you Sure  to Delete Data');" href="?catId=<?php echo $result['id'];?>">Delete</a></td>
                </tr>
                <?php } }?>
            </tbody>
        </table>
    </div>
    </div>
</div>
<script type="text/javascript">

$(document).ready(function () {
    setupLeftMenu();

    $('.datatable').dataTable();
    setSidebarHeight();


});
</script>
<?php include_once 'inc/footer.php'; ?>
