<?php
require 'pdo.php';
session_start();


if (isset($_POST['name'])) {


  if (strpos($_POST['email'], '@') === false) {
    $_SESSION['error'] = 'invalid email';
    header('Location: edit.php?user_id=' . $_POST['user_id']);
    return;
  }

  $sql = "UPDATE users SET name = :name, class = :class, email = :email, phone = :phone WHERE user_id = :user_id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(
    ':name' => $_POST['name'],
    ':class' => $_POST['class'],
    ':email' => $_POST['email'],
    ':phone' => $_POST['phone'],
    ':user_id' => $_POST['user_id']
  ));
  $_SESSION['success'] = 'Record updated';
  header('Location: index.php');
  return;

  // $data = $pdo->prepare('UPDATE users SET name = :name, class = :class, email = :email, phone = :phone WHERE user_id = :user_id');
  // $data->execute(array(
  //   ':name' => $_POST['name'],
  //   ':class' => $_POST['class'],
  //   ':email' => $_POST['email'],
  //   ':phone' => $_POST['phone']
  // ));
  // $_SESSION['success'] = 'record updated!';
  // header('Location: index.php');
  // return;
}

//double check everything
if (!isset($_GET['user_id'])) {
  $_SESSION['error'] = "Missing user_id";
  header('Location: index.php');
  return;
}


$sql = 'SELECT * FROM users where user_id = :xyz';
$stmt = $pdo->prepare($sql);
$stmt->execute(array(":xyz" => $_GET['user_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row === false) {
  $_SESSION['error'] = 'Bad value for user_id';
  header('Location: index.php');
  return;
}

//flash message
if (isset($_SESSION['error'])) {
  echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>\n';
  unset($_SESSION['error']);
}

$name = htmlentities($row['name']);
$class = htmlentities($row['class']);
$email = htmlentities($row['email']);
$phone = htmlentities($row['phone']);
$user_id = $row['user_id'];


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
          <input type="text" name="name" class="form-control" value=" <?= $name ?>" required />
        </div>
        <div class="col-md-6 mb-3">
          <label for="validationDefault02">Class</label>
          <input type="text" name="class" class="form-control" value=" <?= $class ?>" required />
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="validationDefault03">E-mail</label>
          <input type="text" name="email" class="form-control" value=" <?= $email ?>" required />
        </div>
        <div class="col-md-6 mb-3">
          <label for="validationDefault03">Phone Number</label>
          <input type="text" name="phone" class="form-control" value=" <?= $phone ?>" required />
        </div>
        <div class="col-md-6 mb-3">
          <input type="hidden" class="form-control" name="user_id" value="<?= $user_id ?>">
        </div>
      </div>

      <button class="btn btn-dark" type="submit">Edit Contact</button>
      <button type="button" class="btn btn-outline-dark">
        <a href="index.php">Cancel</a>
      </button>
    </form>
  </div>
</body>

</html>