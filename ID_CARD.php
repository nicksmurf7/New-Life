<!DOCTYPE html>
<html>
   <head>
      <link rel="stylesheet" href="card_style.css">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <title>New ID Card</title>
   </head>
   <body>
      <center>
         <h1> New ID Card </h1>
         <div id="slide-wrapper" >
            <!-- <img id="slideLeft" class="arrow" src="images/arrow-left.png"> -->
            <i 	
               id="slideLeft"
               class="fa fa-chevron-left arrow"
               >	
            </i>
            <div id="slider">
               <div class = "panel">
                  <div class = "id_card">
                     <div class = "id_card__face id_card__face-front">
                        <div class="top">
                           <div class="tag_hole"></div>
                           <h2><img src="Corgi.JPG"  class= "avatar" alt="Avatar" ></h2>
                        </div>
                        <div class="bottom_info_box">
                           <h2>Pillow Li </h2>
                           <h5>Doggy Leader</h5>
                           <h3>Doggy Academy</h3>
                        </div>
                     </div>
                     <div class = "id_card__face id_card__face-back">
                        <div class="tag_hole"></div>
                        <div class="back_info_box">
                           <h2>Pillow Li </h2>
                           <h5>Doggy Leader</h5>
                           <h3>Doggy Academy</h3>
                        </div>
                     </div>
                  </div>
               </div>
               <div class = "panel">
                  <div class = "id_card">
                     <div class = "id_card__face id_card__face-front">
                        <div class="top">
                           <div class="tag_hole"></div>
                           <h2><img src="Corgi.JPG"  class= "avatar" alt="Avatar" ></h2>
                        </div>
                        <div class="bottom_info_box">
                           <h2>Pillow Li </h2>
                           <h5>Doggy Leader</h5>
                           <h3>Doggy Academy</h3>
                        </div>
                     </div>
                     <div class = "id_card__face id_card__face-back">
                        <div class="tag_hole"></div>
                        <div class="back_info_box">
                           <h2>Pillow Li </h2>
                           <h5>Doggy Leader</h5>
                           <h3>Doggy Academy</h3>
                        </div>
                     </div>
                  </div>
               </div>
               <div class = "panel">
                  <div class = "id_card">
                     <div class = "id_card__face id_card__face-front">
                        <div class="top">
                           <div class="tag_hole"></div>
                           <h2><img src="Corgi.JPG"  class= "avatar" alt="Avatar" ></h2>
                        </div>
                        <div class="bottom_info_box">
                           <h2>Pillow Li </h2>
                           <h5>Doggy Leader</h5>
                           <h3>Doggy Academy</h3>
                        </div>
                     </div>
                     <div class = "id_card__face id_card__face-back">
                        <div class="tag_hole"></div>
                        <div class="back_info_box">
                           <h2>Pillow Li </h2>
                           <h5>Doggy Leader</h5>
                           <h3>Doggy Academy</h3>
                        </div>
                     </div>
                  </div>
               </div>
               <div class = "panel">
                  <div class = "id_card">
                     <div class = "id_card__face id_card__face-front">
                        <div class="top">
                           <div class="tag_hole"></div>
                           <h2><img src="Corgi.JPG"  class= "avatar" alt="Avatar" ></h2>
                        </div>
                        <div class="bottom_info_box">
                           <h2>Pillow Li </h2>
                           <h5>Doggy Leader</h5>
                           <h3>Doggy Academy</h3>
                        </div>
                     </div>
                     <div class = "id_card__face id_card__face-back">
                        <div class="tag_hole"></div>
                        <div class="back_info_box">
                           <h2>Pillow Li </h2>
                           <h5>Doggy Leader</h5>
                           <h3>Doggy Academy</h3>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <i 	
               id="slideRight"
               class="fa fa-chevron-right arrow"
               ></i>	
         </div>
      </center>
      <script type="text/javascript">
         document.querySelectorAll(".id_card").forEach(card => {
         			card.addEventListener('click', () => {
           		card.classList.toggle('is-flipped');
         			});
         });
         
         
         
         let buttonRight = document.getElementById('slideRight');
         let buttonLeft = document.getElementById('slideLeft');
         
         buttonLeft.addEventListener('click', function(){
         	document.getElementById('slider').scrollLeft -= 180
         })
         
         buttonRight.addEventListener('click', function(){
         	document.getElementById('slider').scrollLeft += 180
         })
         
         
         
         
      </script>
      <?php include("rating.php");?>
   </body>
</html>