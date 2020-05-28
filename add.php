<?php
require "pdo.php";
session_start();


if (
  isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['class'])
) {

  // Data validation
  if (strpos($_POST['email'], '@') === false) {
    $_SESSION['error'] = 'Bad data';
    header("Location: add.php");
    return;
  }

  $sql = "INSERT INTO users (name, email, class, phone)
  VALUES (:name, :email, :class, :phone)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(
    ':name' => $_POST['name'],
    ':email' => $_POST['email'],
    ':class' => $_POST['class'],
    ':phone' => $_POST['phone']
  ));
  $_SESSION['success'] = 'Record Added';
  header('Location: index.php');
  return;
}



if (isset($_SESSION['error'])) {
  echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>\n';
  unset($_SESSION['error']);
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
  <link rel="stylesheet" href="style.css" />
  <title>Document</title>
</head>

<body>
  <nav class="navbar navbar-dark bg-dark">
    <span class="navbar-brand mb-0 h1">Student Contact's Book</span>
  </nav>
  <div class="container">
    <form method="POST">
      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="validationDefault01">Name</label>
          <input type="text" class="form-control" name="name" placeholder="John Doe" required />
        </div>
        <div class="col-md-6 mb-3">
          <label for="validationDefault02">Class</label>
          <input type="text" class="form-control" name="class" placeholder="2018/145020" required />
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="validationDefault03">E-mail</label>
          <input type="text" class="form-control" name="email" placeholder="maryamahkarpov@mgdv.edu.cn" required />
        </div>
        <div class="col-md-6 mb-3">
          <label for="validationDefault03">Phone Number</label>
          <input type="text" class="form-control" name="phone" placeholder="+62 858-7652-1282" required />
        </div>
      </div>
      <button class="btn btn-dark" type="submit">
        Add New
      </button>
      <button type="button" class="btn btn-outline-dark">
        <a href="index.php">Cancel</a>
      </button>
    </form>
  </div>
</body>

</html>