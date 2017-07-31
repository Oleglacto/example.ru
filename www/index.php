<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Тестовая страница</title>
      <link href="/styles/normalize.min.css" rel="stylesheet" type="text/css">
      <link href="/styles/style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
  <header class="main-header">
      <?php require(__DIR__ . "/../views/header.php");?>
  </header>
  <main class="container">
        <?php require (__DIR__.'/../views/content.php');?>
  </main>
  <footer class="main-footer">
      <?php require (__DIR__.'/../views/footer.php'); ?>
  </footer>
  </body>
</html>
