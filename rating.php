<!DOCTYPE html>
<html>
   <head>
      <link rel="stylesheet" href="ratingbar.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
      <title>rating</title>
   </head>
   <body>
      <script>
         function closeForm() {
           document.getElementById("container").style.display = "none";
         }
      </script>
      <div class = "form-popup form-container" id = "container">
         <div class="stars">
            <span class="material-icons close" id= "close" onclick="closeForm()">cancel</span>
            <br>
            <h2> How did we do? 	</h2>
            <form name="form" id="form" action="rating.php" method="post">
               <input class="star star-5" id="star-5" type="radio" name="star" value =5 />
               <label class="star star-5" for="star-5"></label>
               <input class="star star-4" id="star-4" type="radio" name="star" value =4 />
               <label class="star star-4" for="star-4"></label>
               <input class="star star-3" id="star-3" type="radio" name="star" value =3 />
               <label class="star star-3" for="star-3"></label>
               <input class="star star-2" id="star-2" type="radio" name="star" value =2 />
               <label class="star star-2" for="star-2"></label>
               <input class="star star-1" id="star-1" type="radio" name="star" value =1 />
               <label class="star star-1" for="star-1"></label>
            </form>
         </div>
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
            
            extract ($_POST);
            if(isset($star)){
            if($star > 0 & $star <6 ){
            update($star[0]);
            echo "<script type='text/javascript'> document.getElementById('form').innerHTML = '<h4>Thank you for your review!</h4>';</script>";
            }
            
            }	
            ?>
         <div>
            <?php
               function output_sql($sql_obj, $type){
               	while ($row = $sql_obj->fetch_assoc()) {
                				return $row[$type];
               	}
               	return "0 elements";
               }
               
               $average = round(output_sql($conn->query("SELECT SUM(count*star)/SUM(count) as avg FROM star"),'avg'), 2);
               $sum = output_sql($conn->query("SELECT SUM(count) as sum FROM star"), 'sum');
               
               ?>
            <script language = "javascript">
               $(function() {
               	$('input[type=radio]').on('change', function(e) {
               	    //$(this).closest("form").submit();
               
               	  	e.preventDefault();
                    	var rate = $("input[name='star']:checked").val();
               	      $.ajax
               	        ({
               	          type: "POST",
               	          url: "form-submit.php",
               	          data: { "star": rate },
               	          success: function (data) {
               	            $('.result').html(data);
               	            document.getElementById('form').innerHTML = ' <h4>Thank you for your review!</h4>';
               	            <?php
                  $average = round(output_sql($conn->query("SELECT SUM(count*star)/SUM(count) as avg FROM star"),'avg'), 2);
                  $sum = output_sql($conn->query("SELECT SUM(count) as sum FROM star"), 'sum');
                  
                  ?>
               	            document.getElementById('info').innerHTML =   <?php echo "\"".$average . " average based on ".  (intval($sum) + 1) . " reviews. \"";?>;
               	            var count_val = parseInt($("#count_star"+rate).html()) +1;
               	            document.getElementById("count_star"+rate).innerHTML = count_val;
               
               
               	          }
                       });
               	});
               });
            </script>
         </div>
         <p id = 'info'>
            <?php echo $average . " average based on ".  $sum . " reviews.";?>
         </p>
         <hr style="border:3px solid #f1f1f1">
         <div class="row">
            <?php
               $star5 = output_sql($conn->query("SELECT count FROM `star` WHERE star = 5"), 'count');
               $p = ($star5*100)/ $sum;
               ?>
            <div class="side">
               <div>5 star</div>
            </div>
            <div class="middle">
               <div class="bar-container">
                  <div class="bar-5" style="width: <?php echo $p; ?>%"></div>
               </div>
            </div>
            <div class="side right">
               <div id ="count_star5"><?php echo $star5; ?></div>
            </div>
            <?php
               $star4 = output_sql($conn->query("SELECT count FROM `star` WHERE star = 4"), 'count');
               $p = ($star4*100)/ $sum;
               ?>
            <div class="side">
               <div>4 star</div>
            </div>
            <div class="middle">
               <div class="bar-container">
                  <div class="bar-4" style="width: <?php echo $p; ?>%"></div>
               </div>
            </div>
            <div class="side right">
               <div id ="count_star4"><?php echo $star4; ?> </div>
            </div>
            <?php
               $star3 = output_sql($conn->query("SELECT count FROM `star` WHERE star = 3"), 'count');
               $p = ($star3*100)/ $sum;
               ?>
            <div class="side">
               <div>3 star</div>
            </div>
            <div class="middle">
               <div class="bar-container">
                  <div class="bar-3" style="width: <?php echo $p; ?>%"></div>
               </div>
            </div>
            <div class="side right">
               <div id ="count_star3"><?php echo $star3; ?> </div>
            </div>
            <?php
               $star2 = output_sql($conn->query("SELECT count FROM `star` WHERE star = 2"), 'count');
               $p = ($star2*100)/ $sum;
               ?>
            <div class="side">
               <div>2 star</div>
            </div>
            <div class="middle">
               <div class="bar-container">
                  <div class="bar-2" style="width: <?php echo $p; ?>%"></div>
               </div>
            </div>
            <div class="side right">
               <div id ="count_star2"><?php echo $star2;?></div>
            </div>
            <?php
               $star1 = output_sql($conn->query("SELECT count FROM `star` WHERE star = 1"), 'count');
               $p = ($star1*100)/ $sum;
               ?>
            <div class="side">
               <div>1 star</div>
            </div>
            <div class="middle">
               <div class="bar-container">
                  <div class="bar-1" style="width: <?php echo $p; ?>%"></div>
               </div>
            </div>
            <div class="side right">
               <div id ="count_star1"><?php echo $star1; ?></div>
            </div>
            <br/><br/><br/>
         </div>
         <?php
            $conn->close();
            ?>
      </div>
   </body>
</html>