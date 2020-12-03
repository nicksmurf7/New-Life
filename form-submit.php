<!DOCTYPE html>
<html>
   <head>
      <title>form submit</title>
   </head>
   <body>
      <?php
         $host		= "localhost"; // Use Local Host Only       
         $username	= "id15495055_rating2020"; 
         $password	= "Amber.123456";  
         $db_name	= "id15495055_rating";  
         
         $conn = mysqli_connect($host, $username, $password, $db_name); 
         
         if (!$conn) { 
         echo "Connection Error". PHP_EOL; 
         echo "Error Code: ". mysqli_connect_errno().PHP_EOL; 
         echo "Error: Description".mysqli_connect_error().PHP_EOL; 
         exit; 
         } 
         
         //echo "Connection to 000webhost Successfull"; 
         function update($val){
         global $conn;
         
         if ($conn->query("UPDATE star SET count = count +1 WHERE star =". $val.""  ) === TRUE) {
         //echo "Record updated successfully";
         } else {
         echo "Error updating record: " . $conn->error;
         }	  
         
         }
         
         extract ($_REQUEST);
      
      
         //email content
         $subject = "Welcome to your new life";
         $emailMSG = "Thank you for your order!  \nYour new identity information has been sent to the email you entered: $email";


         //call id image creator, add image to email


         mail($email, $subject, $emailMSG);

         //form to leave a review
         //send form data to database
         //display reviews
      
      
         if(isset($star)){
         if($star > 0 & $star <6 ){
         update($star[0]);
         }
         
         }	
         $conn->close();
      
         
         ?>
   </body>
</html>
