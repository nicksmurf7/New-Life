

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="card_style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amatic+SC" />
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <title>New ID Card</title>
     <style>
         
         .PrettyFont {
             font-family: "Amatic SC", sans-serif;
         }
      </style>
    
</head>

<?php 
   
    extract($_POST);
    $age = [];
    $sex = [];
    $ethnicity = [];
    $nationality = [];
    $eyecolor = [];
    $donor = [];
    $statistic =[];
    $photo =[];

    function api_info($sex, $nationality, $ethnicity, $eyecolor, $donor){
         $link = "https://randomuser.me/api/?";
         if ($sex != "") {
            $link .= "gender=" . $sex . "&";
         }
          if ($nationality != "") {
            $link .= "nat=" . $nationality;
         }

         if(substr($link, -1) === "&" || substr($link, -1) === "?" ){
            $link = substr($link,0, -1);

         }
         $answer = file_get_contents($link); 

         if($answer ===false){
            echo "API LOADING PROBLEM ..." ;
            echo '<script type="text/javascript">location.reload(true);</script>';
         }  
         return $answer;       
    }

    function determineAge($age){
         //echo $age;
         
         $age = intval($age);
         if($age < 1){
            return "infant";
         }else if($age < 12){
            return "child";
         }else if($age < 25){
            return "young-adult";
         }else if($age < 50){
            return "adult";
         }else{
            return "elderly";
         }
    }
    function api_photo($gender,$nationality, $ethnicity, $eyecolor,$donor,$age){
       $link = "https://api.generated.photos/api/v1/faces?api_key=GTR15QDXCBeYQZdpcM4e0g&per_page=1&order_by=random&";
       $link .= "gender=" . $gender . "&";
       if($eyecolor != ""){
         $link .= "eye_color=" . $eyecolor . "&";
       }
       if($ethnicity != ""){
         $link .= "ethnicity=" . $ethnicity . "&";
       }
       $link .="age=".determineAge($age);
         //echo("-----this is: ".$sex[$i]."-----");
       return file_get_contents($link); 
       //echo "link :". $link . "   ";
    }
    function determineGender($s){
         if($s != "male" & $s != "female"){
            if(rand(0,1)===1){
               return "male";
            }
            return "female";
         }

         return $s;
    }
    for ($i = 0;$i < $numids;$i++)
    {
        //${'sex'.$i} = determineGender(${'sex'.$i});
        array_push($sex,determineGender(${'sex'.$i}));
        array_push($ethnicity, $
        {
            'ethnicity' . $i
        });
        array_push($age, $
        {
            'age' . $i
        });
        array_push($nationality, $
        {
            'nationality' . $i
        });
        array_push($eyecolor, $
        {
            'eyecolor' . $i
        });
        array_push($donor, $
        {
            'donor' . $i
        });
        try {
             array_push($statistic, api_info($sex[$i], $nationality[$i], ${'ethnicity' . $i}, ${'eyecolor' . $i}, ${'donor' . $i}));
         } catch (ErrorException $e) {
             echo "API LOADING PROBLEM ..." . $e;
             header("Refresh:0");
         }
         //$play =  "". api_photo($sex[$i], $nationality[$i], ${'ethnicity' . $i}, ${'eyecolor' . $i}, ${'donor' . $i},$age[$i]);
         $play = '{}';
         array_push($photo, $play);
       
    } 

    
?>

<body style =" font-family: monospace;" id ="body">

   <!-- <button onClick="window.print()">Print this page</button> -->

    <center>
        <h1 class = "PrettyFont" style =" color:white;font-size: 5em"> New ID Card </h1>

        <div id="slide-wrapper">
            <!-- <img id="slideLeft" class="arrow" src="images/arrow-left.png"> -->
            <i id="slideLeft" class="fa fa-chevron-left arrow">    
            </i>
            <div id="slider">

            </div>
            <i id="slideRight" class="fa fa-chevron-right arrow"></i>
        </div>
        <button onClick="sendEmail()">Send Email</button>
        <div id = "email" class ="PrettyFont" style = "color:white;"></div>
    </center>
    <script type="text/javascript">

        $(document).ready(function() {
            makeFlip();
        })
        makeFlip();
        

        var numids = <?php echo $numids ?> ;
        var email = <?php echo "'".$email.
        "'" ?> ;
        var sex = <?php echo json_encode($sex) ?> ;
        var ethnicity = <?php echo json_encode($ethnicity) ?> ;
        var nationality = <?php echo json_encode($nationality) ?> ;
        var eyecolor = <?php echo json_encode($eyecolor) ?> ;
        var donor = <?php echo json_encode($donor) ?> ;
        var age = <?php echo json_encode($age) ?> ;
        var statistic = <?php echo json_encode($statistic) ?> ;
        var photo = <?php echo json_encode($photo) ?> ;
        var back_info = [];
        var front_info = [];


        //------------------------------------------------------------------------------------------------------------------//
        //input information to create id card
        function createCard(avatar, front_info, back_info, i) {
            if(avatar == ""){
               avatar = "Corgi.JPG";
            }
            card = "<div class = \"panel\" id = 'panel"+i+"''><div class = \"id_card\"><div class = \"id_card__face id_card__face-front\">";
            //front top part
            card += "<div class=\"top\"><div class=\"tag_hole\"></div><div id ='avatar" + i + "'><img src=\"" + avatar + "\"  class= \"avatar\" alt=\"Avatar\" ></div></div>";
            //front buttom part
            card += "<div class=\"bottom_info_box\" id ='front" + i + "'>" + front_info + "</div></div>";

            card += "<div class = \"id_card__face id_card__face-back\"><div class=\"tag_hole\"></div><div class=\"back_info_box\" style = 'margin-top:10%' id ='back" + i + "'>" + back_info + "</div>";

            card += "<input type=\"button\" onclick=\"printDiv("+i+")\" value=\"PRINT\" /></div></div></div>";

            document.getElementById('slider').innerHTML += card;

        }

        function printDiv(i) {
           var printContents= "<title>ID Details</title>";
           printContents += "<link rel=\"stylesheet\" href=\"card_style.css\">";
           printContents += document.getElementById("avatar"+i).innerHTML;
           printContents+= document.getElementById("front"+i).innerHTML;
           printContents += document.getElementById("back"+i).innerHTML;
           
           // var originalContents = document.body.innerHTML;

           // document.body.innerHTML = printContents;

           var mywindow = window.open('', 'my div', 'height=400,width=600');
           mywindow.document.write(printContents);
           mywindow.document.close(); // necessary for IE >= 10
           
           myDelay = setInterval(checkReadyState, 10);

             function checkReadyState() {
                 if (mywindow.document.readyState == "complete") {
                     clearInterval(myDelay);
                     mywindow.focus(); // necessary for IE >= 10

                     mywindow.print();
                     mywindow.close();
                 }
             }
            return true;
           // document.body.innerHTML = originalContents;
      }

        
        for (t = 0; t < numids; t++) {
                statistic[t] = JSON.parse(statistic[t]);
                photo[t] = JSON.parse(photo[t]);

                front = "<h3> Name: " + statistic[t]["results"][0]["name"]["first"] + " " + statistic[t]["results"][0]["name"]["last"] + "<br></h3>";
                front += "<h4> Gender: " + statistic[t]["results"][0]["gender"]+ "<br></h3>";

                front += "<h4> DOB: " + calcAge(age[t]) +statistic[t]["results"][0]["dob"]["date"].substring(4,10)+ "<br></h3>";
              
                front += "<h5> Address: " + statistic[t]["results"][0]["location"]["street"]["number"] + " "+ statistic[t]["results"][0]["location"]["street"]["name"] + ", " +  statistic[t]["results"][0]["location"]["city"] + ", " + statistic[t]["results"][0]["location"]["state"] +  ", "+statistic[t]["results"][0]["location"]["country"] + ", "+statistic[t]["results"][0]["location"]["postcode"]  +"<br></h3>";

                front += inputDonor(donor[t]);

                back = "" ;
                back += makeTag(statistic[t]["results"][0]["location"]["country"], "Nationality")
                back += makeTag(statistic[t]["results"][0]["email"], "Email");
                back += makeTag(statistic[t]["results"][0]["phone"], "Phone");
                back += makeTag(""+statistic[t]["results"][0]["login"]["uuid"], "UUID");
                back += makeTag(""+statistic[t]["results"][0]["id"]["name"]+ statistic[t]["results"][0]["id"]["value"], "ID Number");
                back += makeTag(statistic[t]["results"][0]["login"]["username"], "Username");
                back += makeTag(statistic[t]["results"][0]["login"]["password"], "Password");
                
               // back += "</h4>";
                  //console.log(back);
                
                  //console.log(photo[t]);
                  //console.log(photo[t]["faces"][0]["urls"]);
                //createCard(photo[t]["faces"][0]["urls"][3]["256"], front, back, t);
                createCard("", front, back, t);

        }
        //------------------------------------------------------------------------------------------------------------------//
        //jquery for flip card
        function makeFlip() {
            document.querySelectorAll(".id_card").forEach(card => {
                card.addEventListener('click', () => {
                    card.classList.toggle('is-flipped');
                });
            });
        }
        let flag=false;
        function sendEmail() {
            info = '<html>'
            info += "<title>ID Details</title>";
            info += "<link rel=\"stylesheet\" href=\"card_style.css\">";
            info += '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';
          
            for (i = 0; i < numids; i++) {
               info +=  document.getElementById("avatar"+i).innerHTML;
               info+= document.getElementById("front"+i).innerHTML;

               info += document.getElementById("back"+i).innerHTML;
               info += "<hr><br>";

            }
            info +='</html>';

            var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  document.getElementById("email").innerHTML = "<h2>"+ this.responseText +"</h2>";
                }
              };
              xhttp.open("POST", "email.php", true);
              xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              xhttp.send("email="+ email +"&info="+info);
           
            
        
            return true;
            //window.open(info);

         }


            //create tag into a string
        function makeTag(info, title) {
            return "<div class = 'stuff' style=\"margin-left:5%; margin-right:5%;overflow: hidden;\"><p  style=\"font-weight:bold;float: left; margin-right:1%;\">"+title + ":</p><p style=\"float: left;\">"+ info + "</p></div>";

        }
        function calcAge(age){
            var d = new Date();
            var n = parseInt(d.getFullYear());
            return n-age;
        }

        function inputDonor(type){

            while(type == "Random" || type == "donor"){
               if(type == "donor"){
                  return '<i class="fa fa-heart" style="font-size:15px;color:red"></i> Organ Donor - Donate Life';
               }else{
                  type = getRandomDonorType();
               }

            }
            return "";   

        }

        function getRandomDonorType() {
            var x = Math.floor(Math.random() * Math.floor(2));
            if(x == 1){
               return "donor";
            }
            return  "notdonor";
         }
        




        demofront = "<h2>Pillow Li </h2><h5>Doggy Leader</h5><h3>Doggy Academy</h3>";
        demoback = "<h2>Pillow Li </h2><h5>Doggy Leader</h5><h3>Doggy Academy</h3>";




        //------------------------------------------------------------------------------------------------------------------//

        //jquery for left/right slide button
        let buttonRight = document.getElementById('slideRight');
        let buttonLeft = document.getElementById('slideLeft');

        buttonLeft.addEventListener('click', function() {
            document.getElementById('slider').scrollLeft -= 180
        })

        buttonRight.addEventListener('click', function() {
            document.getElementById('slider').scrollLeft += 180
        })
    </script>
    
    <?php include( "rating.php");?>
    
 
</body>

</html>
