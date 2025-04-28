<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Book</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <?php
  session_start();
  include("config.php");
  $config = new Config();

  $id = $_SESSION['id'];
  $name = $_SESSION['name'];
  $writer = $_SESSION['writer'];
  $details = $_SESSION['details'];
  $price = $_SESSION['price'];

  if (isset($_REQUEST['button'])) {
    $name = $_POST['name'];
    $writer = $_POST['writer'];
    $details = $_POST['details'];
    $price = $_POST['price'];
    $result = $config->editStudent($id, $name, $writer, $details, $price);
    if (isset($result)) {
      echo "data update !";
      header('Location:index.php');
    } else {
      echo "data fix !";
    }
  }
  ?>

  <div class="container my-5">
    <h3 class="text-center mb-4">📘 Update Book Information</h3>

    <div class="d-flex justify-content-center">
      <form method="post" class="border p-4 rounded shadow bg-light" style="min-width: 320px; max-width: 500px; width: 100%;">
        <div class="mb-3">
          <label for="name" class="form-label">Book Name</label>
          <input name="name" type="text" class="form-control" placeholder="Enter Book Name here.." value="<?php echo $name; ?>">
        </div>

        <div class="mb-3">
          <label for="writer" class="form-label">Book Writer</label>
          <input name="writer" type="text" class="form-control" placeholder="Enter Book Writer here.." value="<?php echo $writer; ?>">
        </div>

        <div class="mb-3">
          <label for="details" class="form-label">Book Details</label>
          <input name="details" type="text" class="form-control" placeholder="Enter Book Details here.." value="<?php echo $details; ?>">
        </div>

        <div class="mb-3">
          <label for="price" class="form-label">Book Price</label>
          <input name="price" type="number" class="form-control" placeholder="Enter Book Price here.." value="<?php echo $price; ?>">
        </div>

        <button name="button" type="submit" class="btn btn-primary w-100">Submit</button>
        <a href="index.php" class="btn btn-secondary w-100 mt-2">Back to Book List</a>
      </form>
    </div>
  </div>

</body>

</html>
