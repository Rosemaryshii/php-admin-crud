<?php

@include 'config.php';

if(isset($_POST['add_product'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   // $product_image = $_FILES['product_image']['name'];
   // $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   // $product_image_folder = 'uploaded_img/'.$product_image;

   if(empty($product_name) || empty($product_price)){
      $message[] = 'please fill out all';
   }else{
      $insert = "INSERT INTO customer_logs(name, price, cname, cinvoice) VALUES('$product_name', '$product_price','$cname','$cinvoice')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         // move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $message[] = 'new product added successfully';
      }else{
         $message[] = 'could not add the product';
      }
   }

};