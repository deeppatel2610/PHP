<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container my-5">
    <h3 class="text-center mb-4">📚 Book Form</h3>

    <form method="post" class="border rounded p-4 shadow-sm bg-light">
      <div class="mb-3">
        <label for="Name" class="form-label">Book Name</label>
        <input name="Name" type="text" class="form-control" id="Name" placeholder="Enter Book Name here..">
      </div>
      <div class="mb-3">
        <label for="Writer" class="form-label">Book Writer</label>
        <input name="Writer" type="text" class="form-control" id="Writer" placeholder="Enter Book Writer here..">
      </div>
      <div class="mb-3">
        <label for="Details" class="form-label">Book Details</label>
        <input name="Details" type="text" class="form-control" id="Details" placeholder="Enter Book Details here..">
      </div>
      <div class="mb-3">
        <label for="Price" class="form-label">Book Price</label>
        <input name="Price" type="number" class="form-control" id="Price" placeholder="Enter Book Price here..">
      </div>
      <button name="button" type="submit" class="btn btn-primary w-100">Submit</button>
    </form>
  </div>

  <div class="container my-5">
    <h3 class="text-center mb-4">📖 Book Data</h3>

    <div class="table-responsive">
      <table class="table table-bordered table-striped text-center align-middle">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Book Name</th>
            <th>Book Writer</th>
            <th>Book Details</th>
            <th>Book Price</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <!-- PHP logic and rows stay the same -->
          <?php
          include("config.php");
          session_start();
          $config = new Config();
          $config->connectDb();
          $response = $config->fetchStudents();

          if (isset($_POST['button'])) {
              $name = $_POST['Name'];
              $writer = $_POST['Writer'];
              $details = $_POST['Details'];
              $price = $_POST['Price'];

              $res = $config->insertStudent($name, $writer, $details, $price);
              if ($res) {
                  echo "data added !";
              } else {
                  echo "data cant added !";
              }
              header("Refresh:0");
          }

          if (isset($_POST['delete'])) {
              $id = $_POST['deleteId'];
              $config->removeStudent($id);
              header("Refresh:0");
          }

          if (isset($_REQUEST['edit'])) {
              $_SESSION['id'] = $_REQUEST['editId'];
              $_SESSION['name'] = $_REQUEST['editName'];
              $_SESSION['writer'] = $_REQUEST['editWriter'];
              $_SESSION['details'] = $_REQUEST['editDetails'];
              $_SESSION['price'] = $_REQUEST['editPrice'];
              header("Location: update.php");
          }

          for ($i = 0; $i < count($response); $i++) { ?>
            <tr>
              <td><?php echo $response[$i]['id']; ?></td>
              <td><?php echo $response[$i]['Book_Name']; ?></td>
              <td><?php echo $response[$i]['Book_Writer']; ?></td>
              <td><?php echo $response[$i]['Book_Details']; ?></td>
              <td><?php echo $response[$i]['Book_Price']; ?></td>
              <form action="" method="post">
                <td>
                  <input type="hidden" name="editId" value="<?php echo $response[$i]['id']; ?>">
                  <input type="hidden" name="editName" value="<?php echo $response[$i]['Book_Name']; ?>">
                  <input type="hidden" name="editWriter" value="<?php echo $response[$i]['Book_Writer']; ?>">
                  <input type="hidden" name="editDetails" value="<?php echo $response[$i]['Book_Details']; ?>">
                  <input type="hidden" name="editPrice" value="<?php echo $response[$i]['Book_Price']; ?>">
                  <button type="submit" class="btn btn-warning btn-sm" name="edit">Edit</button>
                </td>
                <td>
                  <input type="hidden" name="deleteId" value="<?php echo $response[$i]['id']; ?>">
                  <button class="btn btn-danger btn-sm" name="delete" type="submit">Delete</button>
                </td>
              </form>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
