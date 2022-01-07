<?php

class userconnect{


public static function login()
  {
 
   global $connect;
            
          $username = htmlentities($connect->real_escape_string($_POST['username']));
          $password = sha1(htmlentities($connect->real_escape_string($_POST['password'])));

             if(empty($username)){
   echo"
<script>
alert('YOU MUST TYPE A USERNAME.');
</script>
   ";
      echo'<META HTTP-EQUIV="refresh" CONTENT="1">';





     }else if(empty($password)){
   
   echo"
<script>
alert('YOU MUST TYPE A PASSWORD.');
</script>
   "; 

      echo'<META HTTP-EQUIV="refresh" CONTENT="4">';
     }else{

$check_usr_pw = $connect->prepare("SELECT * FROM users WHERE username= ? AND password = ? ");
$check_usr_pw->bind_param("ss", $username,$password);
$check_usr_pw->execute();

$check_usr_pw->store_result();





if($check_usr_pw->num_rows)
{


$_SESSION['username']=$username;


echo'<meta http-equiv="refresh" content="0">';




}else{

   echo"

<script>
alert('USERNAME OR PASSWORD IS WRONG.');
</script>
    
"; 
      echo'<META HTTP-EQUIV="refresh" CONTENT="4">';
}
}
}


// register function
public static function register()
{

  global $connect;

  $username = htmlentities($connect->real_escape_string($_POST['username']));
  $password =  sha1(htmlentities($connect->real_escape_string($_POST['password'])));
  $email = htmlentities($_POST['email']);
  $rank = 0;
  $regdate = date("Y/m/d");


  
  $check_username = $connect->prepare("SELECT * FROM users WHERE username = ? ");
  $check_username->bind_param("s", $username);
  $check_username->execute();
  $check_username->store_result();

  $row_name_user = $check_username->num_rows;

  $check_username->close();
  

  $check_email = $connect->prepare("SELECT * FROM users WHERE  email = ?");
  $check_email->bind_param("s", $email);
  $check_email->execute();
  $check_email->store_result();

  $row_name_email = $check_email->num_rows;

  $check_email->close();


  if($row_name_user){
   echo"
   <script>
   alert('The username is already in use.');
   </script>
   ";
   

  }else if($row_name_email){
   echo"
   <script>
   alert('The email is already in use.');
   </script>
   ";

  }else{




  $save = $connect->prepare("INSERT INTO users (username,password,email,rank) VALUES(?, ?, ?, ?)");
  $save->bind_param("sssi", $username,$password,$email,$rank);
  $save->execute();

  echo"<script>alert('Your account was created successfully.');</script>";
 
  

}
// End of register function

}
}
