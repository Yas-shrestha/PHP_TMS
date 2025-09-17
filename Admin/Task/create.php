<?php
include "../Layouts/header.php";
include "../Layouts/nav.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>


<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  // var_dump($_POST);
  $title = $_POST['title'];
  $description = $_POST['description'];
  $assigned_to = $_POST['assigned_to'];
  $assigned_by = $_SESSION['user']['id'];
  if ($title != "" && $description != "" && $assigned_to != "") {
    $insert_query = "INSERT INTO tasks (title,description,assigned_to,assigned_by) VALUES('$title','$description','$assigned_to','$assigned_by')";
    $insert_result = $conn->query($insert_query);
    if ($insert_result) {
      header('location:/Admin/Task/manage.php');
    } else {
?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Value Not Inserted
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php
    }
  } else {
    ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      Please Fill all the fields
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
  }
}

?>
<div class="container p-5">
  <form class="row g-3 needs-validation shadow p-5 rounded-3" method="POST" novalidate>
    <div class="d-flex align-item-center justify-content-between">
      <h1 class="text-center text-primary">Create Task</h1>
      <a href="./manage.php" class="btn btn-secondary">Manage</a>
    </div>
    <!-- title -->
    <div class="col-md-12">
      <label for="validationCustom03" class="form-label">Title</label>
      <input type="text" class="form-control" name="title" id="validationCustom03" required>
      <div class="invalid-feedback">
        Please provide a valid city.
      </div>
    </div>
    <!-- title -->
    <!-- task Desc -->

    <div class="mb-3">
      <label for="exampleFormControlTextarea1" class="form-label">Description</label>
      <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"></textarea>
    </div>
    <!-- task Desc -->
    <!-- select assigned to  -->
    <div>
      <label for="assigned_to">Assiged To</label>
      <select class="form-select" id="assigned_to" name="assigned_to" aria-label="Default select example">
        <option selected>Open this select menu</option>
        <?php
        $select_query = "SELECT * FROM users";
        $query = $conn->query($select_query);
        $users = mysqli_fetch_all($query, MYSQLI_ASSOC);
        foreach ($users as $user) {
        ?>
          <option value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
        <?php
        }
        ?>
      </select>
    </div>
    <!-- select assigned to  -->
    <div class="col-12">
      <button class="btn btn-primary" type="submit">Submit form</button>
    </div>
  </form>
</div>
<?php
include "../Layouts/footer.php";
?>