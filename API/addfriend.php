<?php
   
   $data = json_decode(file_get_contents('php://input'), true);
   header('Access-Control-Allow-Origin: *');
   header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
   header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
    $group_id=$data['group_id'];
    $frd_name=$data['frd_name'];
    $mob_no=$data['mob_no'];
    $email_id=$data['email_id'];

    if(!empty($frd_name) && !empty($mob_no) && !empty($email_id))
    {

        $cn=@mysql_connect("localhost","root","");
        $db=mysql_select_db("spending_tracker",$cn);
        
        $q="insert into friend_detail(frd_name,mob_no,email_id) values ('$frd_name',$mob_no,'$email_id')";
        mysql_query($q,$cn);
        $frd_id = mysql_insert_id();        
        $q="insert into group_member(group_id,frd_id) values ('$group_id',$frd_id)";
        mysql_query($q,$cn);
        $response['message']= "Friend added Successfully";
        $response['status_code'] = 200;
        echo json_encode($response);
    }

    else
    {
        $response['message']= "Please fill all Field";
        $response['status_code'] = 200;
        echo json_encode($response);
    }
?>