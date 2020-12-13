<?php
            extract($_POST);
            //$to = $email;

            //$subject = "Your Service Details";
            //$headers = "From:NewLife@info.com\r\n" ;
            // //$headers .= "MIME-Version: 1.0\r\n";
            // //$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // //echo mail($to,$subject,$info,$headers);
            // if(mail($to,$subject,$info,$headers))
            // {
            //     echo "Email Sent To ". $to ."</br>" ;

            //     //echo "Message accepted";
            // }
            // else
            // {
            //     echo "Error: Message not accepted";
            // }

            $to = $email;
            $subject = "Your Service Details";
            $headers = "From:NewLife@info.com\r\n" ;
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            if(mail($to,$subject,$info,$headers))
            {
                echo "Email Sent To ". $email ."</br>" ;
                //echo "Message accepted";
            }
            else
            {
                echo "Error: Message not accepted";
            }
?>