<?php
$selectedCategory="";

     if(isset($_GET["categoryid"]) && is_numeric($_GET["categoryid"]))
     {
            $selectedCategory=$_GET["categoryid"];
     }
 
?>
<div class="list-group">
    <a href="courses.php"  class="list-group-item list-group-item-action">Tüm Kurslar</a>
    <?php 
          $result=GetCategories();
          while($category=mysqli_fetch_assoc($result)): ?>
        <a 
            href="<?php  echo "courses.php?categoryid=".$category["id"]?>" 
            class="list-group-item list-group-item-action
            <?php 
            
                 if($category["id"] == $selectedCategory)
                 {
                        echo "active";
                 }
                 
            
            ?>">
            <?php echo $category["kategoriAdi"]; ?>
        </a>

    <?php endwhile; ?>
</div>