<?php
    require "libs/variables.php";
    require "libs/functions.php";
    include "libs/Ayar.php";
?>

<?php include "partials/_header.php" ?>
<?php include "partials/_navbar.php" ?>

<?php
    $usernameErr = $emailErr = $passwordErr = $repasswordErr ="";
    $username = $email = $password = $repassword = "";
   
    if($_SERVER["REQUEST_METHOD"]=="POST") {

        if(empty($_POST["username"])) {
            $usernameErr = "username gerekli alan.";
        }elseif(strlen($_POST["username"]) < 8 or strlen($_POST["username"])>20  ){
            $usernameErr = "username  8-20 karakter arasında olmalıdır.";
        }
        elseif(!preg_match('/^[A-Za-z][A-Za-z0-9]{5,31}$/',$_POST["username"]))
        {
            $usernameErr = "sadece sadece,rakam,harf ve altCizgi karakterlerini içermelidir.";
        }
        else {
               $sql="SELECT id FROM  users WHERE username=?";
               
               if($stmt=mysqli_prepare($baglanti,$sql))
                 {
                       $param_username= $username = safe_html($_POST["username"]);
                        mysqli_stmt_bind_param($stmt,"s",$param_username);

                        if(mysqli_stmt_execute($stmt))
                        {
                             mysqli_stmt_store_result($stmt);
                                 if(mysqli_stmt_num_rows($stmt)==1)
                                 {
                                     $usernameErr="kullanıcı Adı Kullanılıyor";
                                 }
                                 else{
                                      $username=safe_html(($_POST["username"]));
                                 }
                        }else{
                             echo   mysqli_errno($baglanti);
                             echo "Errorr!!";
                        }

                    $param_email= $email = safe_html($_POST["email"]);
                    
                 }




            $username = safe_html($_POST["username"]);
        }
        if(empty($_POST["email"])) {
            $emailErr = "email gerekli alan.";
        }elseif(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
        {
            $emailErr = "email hatalı";   
        }
        else {
            $sql="SELECT id FROM  users WHERE email=?";
               
            if($stmt=mysqli_prepare($baglanti,$sql))
              {
                    $param_email= $email = safe_html($_POST["email"]);
                     mysqli_stmt_bind_param($stmt,"s",$param_email);

                     if(mysqli_stmt_execute($stmt))
                     {
                          mysqli_stmt_store_result($stmt);
                              if(mysqli_stmt_num_rows($stmt)==1)
                              {
                                  $emailErr=" email Kullanılıyor";
                              }
                              else{
                                   $email=safe_html(($_POST["username"]));
                              }
                     }else{
                          echo   mysqli_errno($baglanti);
                          echo "Errorr!!";
                     }

                 
              }


            $email = safe_html($_POST["email"]);
        }
        if(empty($_POST["password"])) {
            $passwordErr = "password gerekli alan.";
        } else {
            $password = safe_html($_POST["password"]);
        }
        if($_POST["password"] != $_POST["repassword"]) {
            $repasswordErr = "parola tekrar alanı eşleşmiyor.";
        } else {
            $repassword = safe_html($_POST["repassword"]);
        }


        if(empty($usernameErr) && empty($emailErr) && empty($passwordErr)&& empty($repasswordErr))
        {
   
              $sql="INSERT INTO users(username,email,password
              )VALUES(?,?,?)";
              if($stmt=mysqli_prepare($baglanti,$sql))
              {
                 $param_username=$username;
                 $param_email=$email;
                 $param_password=password_hash($password,PASSWORD_DEFAULT);

                mysqli_stmt_bind_param($stmt,"sss",$param_username,$param_email,$param_password);
                if(mysqli_stmt_execute($stmt))
                {
                    header("location:login.php");
                }else{
                     echo mysqli_errno($baglanti);
                     echo  "Error!!";
                }

              }
        }
       
        
    }

?>

<div class="container my-3">

    <div class="row">
        <div class="col-12">
           <form action="register.php" method="post" novalidate> 
            <div class="mb-3">
                <label for="username">Kullanıcı Adı</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username;?>">
                <div class="text-danger"><?php echo $usernameErr; ?></div>
            </div>
            <div class="mb-3">
                <label for="email">Eposta</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email;?>">
                <div class="text-danger"><?php echo $emailErr; ?></div>
            </div>
            <div class="mb-3">
                <label for="password">Parola</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password;?>">
                <div class="text-danger"><?php echo $passwordErr; ?></div>
            </div>
            <div class="mb-3">
                <label for="repassword">Parola Tekrar</label>
                <input type="password" name="repassword" class="form-control">
                <div class="text-danger"><?php echo $repasswordErr; ?></div>
            </div>
            <button type="submit" class="btn btn-primary">Kayıt Ol</button>
           </form>
        </div>
    </div>

</div>
<?php include "partials/_footer.php" ?>
