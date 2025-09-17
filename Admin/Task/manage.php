<?php
include "../Layouts/header.php";
include "../Layouts/nav.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php
// $id =  $_SESSION['user']['id'];
$limit = 4;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$offset = ($page - 1) * $limit;
$count_total_data = "SELECT * FROM tasks ";
$count_total_result = $conn->query($count_total_data);
// print_r($count_total_result);
$total_data = $count_total_result->num_rows;
$total_pages = ceil($total_data / $limit)


?>

<div class="container p-5">
    <div class="card">
        <div class="card-header">
            <a href="./create.php" class="btn btn-sm btn-primary float-end">Add Task</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <td>SN</td>
                            <td>Title</td>
                            <td>Description</td>
                            <td>Assigned_by</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $user_id = $_SESSION['user']['id'];
                        $select_query = "SELECT * FROM tasks LIMIT $offset ,$limit";
                        $select_result = $conn->query($select_query);
                        $tasks = mysqli_fetch_all($select_result, MYSQLI_ASSOC);
                        $i = 1;
                        foreach ($tasks as $task) {
                        ?>
                            <tr>
                                <td><?php echo $i++ ?></td>
                                <td><?= $task['title'] ?></td>
                                <td><?= $task['description'] ?></td>
                                <td><?= $task['assigned_by'] ?></td>
                                <td>

                                    <a href="edit.php?id=<?= $task['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="delete.php?id=<?= $task['id'] ?>" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>


                <nav aria-label="Page navigation example">
                    <ul class="pagination pagination-sm">
                        <li class="page-item <?= $page <= 1 ? 'dis  abled' : '' ?> ">
                            <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                                <span aria-hidden="true">Previous</span>
                            </a>
                        </li>
                        <?php
                        for ($i = 1; $i <= $total_pages; $i++) {
                        ?>
                            <li class="page-item <?= $i == $page ? 'active' : '' ?> "><a class="page-link" href="?page=<?= $i ?>"> <?= $i ?> </a></li>
                        <?php
                        }
                        ?>
                        <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                                <span aria-hidden="true">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<?php
include "../Layouts/footer.php";
?>