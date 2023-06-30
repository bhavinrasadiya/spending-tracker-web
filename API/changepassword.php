<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
    $data = json_decode(file_get_contents('php://input'), true);

    $group_id=$data['group_id'];
    $password=$data['password'];
    $newpassword = $data['newpassword'];
    $confirmnewpassword = $data['confirmnewpassword'];

    $cn=@mysql_connect("localhost","root","");
    $db=mysql_select_db("spending_tracker",$cn);
    $q = mysql_query("SELECT password FROM groups_detail WHERE group_id='$group_id'");

        if(!$q)
        {
        echo "The username you entered does not exist";
        }
        else if($password!= mysql_result($q, 0))
        {
        echo "You entered an incorrect password";
        }
        if($newpassword=$confirmnewpassword)
        $sql=mysql_query("UPDATE groups_detail SET password='$newpassword' WHERE group_id='$group_id'");
        if($sql)
        {
        echo "Congratulations You have successfully changed your password";
        }
       else
        {
       echo "Passwords do not match";
       }


?>