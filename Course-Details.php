<?php
    require "libs/variables.php";
    require "libs/functions.php";
  
    if(!isset($_GET["id"]) or !is_numeric($_GET["id"]))
    {
        header('Location:index.php');
         
    }

    $result=GetCourseById($_GET["id"]);
    $Course=mysqli_fetch_assoc($result);

?>

<?php include "partials/_header.php" ?>
<?php include "partials/_navbar.php" ?>

<div class="container my-3">
    <div class="card">
       <div class="row">
           <div class="col-4">
                    <img src="img/<?php echo $Course["resim"]; ?>" alt="<?php  echo $Course["baslik"];   ?>" class="img-fluid">
            </div>

            <div class="col-8">
                  <div class="card-body">
                        <h1 class="h4 card-title" >
                               <?php  echo $Course["baslik"]; ?>   
                        </h1>
                        <p class="card-text">
                          <?php  echo $Course["altbaslik"]; ?>
                        </p>
                        <p>
                          <?php  echo htmlspecialchars_decode($Course["aciklama"]); ?>
                       </p>
                  </div>
               
           </div>
        
      </div>
      
    </div>
      
</div>
<?php include "partials/_footer.php" ?>

<?php // include "partials/_Static_Command.php" ?>
