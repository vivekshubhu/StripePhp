
<?php
    session_start();
?>

<html>
<head>
  <title>Thanks for your order!</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <section>
    <p>
      Payment Completed Successfully form email <?php echo $_SESSION['email']; ?>
    </p>
  </section>
</body>
</html>