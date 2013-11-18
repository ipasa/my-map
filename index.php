<!DOCTYPE html> 
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />

        <title>Seat Plan Of JNU</title>

        <link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
        <link rel="stylesheet" type="text/css" href="css/demo.css" media="all" />
        <link href="css/main.css" rel="stylesheet"/>

    </head>

<body class="listing">
<?php include('_include/menu.php'); ?>

  <?php if (isset($_GET['error'])) { ?>
  <div class="error_notice">
    <p><?php echo $_GET['error']; ?></p>
  </div>
  <?php } ?>

<!-- <?php echo isset($_GET['error'])?$_GET['error']:"";?> -->
  <div class="container-form">     
    <div  class="form">
      <form id="contactform" action="map.php" method="post"> 
        <p class="contact">
          <label for="roll">Enter Your Roll Number : </label>
        </p> 

        <input id="roll" name="roll" placeholder="e.g. 1401404" required="" tabindex="1" type="text"> 
        <input class="buttom" name="submit" id="submit" tabindex="5" value="Submit" type="submit"> 	 
      </form> 
    </div>      
  </div>
  <?php include('_include/footer.php'); ?>
</body>
</html>
