<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
    $data = json_decode(file_get_contents('php://input'), true);
    
    $group_name=$data['group_name'];
    $group_id=$data['group_id'];
    $password=$data['password'];
    $confirmpassword=$data['confirmpassword'];
    if(!empty($group_name) && !empty($group_id) && !empty($password) && !empty($confirmpassword))
    {
      if($password==$confirmpassword) 
        {
        $cn=@mysql_connect("localhost","root","");
        $db=mysql_select_db("spending_tracker",$cn);
        $q1="select group_id from groups_detail where group_id='$group_id'";
        $result=mysql_query("$q1",$cn);
        if(mysql_num_rows($result)==0)
            {
                $q="insert into groups_detail(group_name,group_id,password) values ('$group_name','$group_id','$password')";
                mysql_query($q,$cn);
                $response['message']= "Signup Successfully";
                $response['status_code'] = 200;
                echo json_encode($response);
        }
        else
        {
        $response['message']= "This Group id is already Exists";
        $response['status_code'] = 400;
        echo json_encode($response);
        }}
        else
        {
            $response['message']= "Password and Confirm Password is Not Match";
            $response['status_code'] = 400;
            echo json_encode($response);
        }
    }

    else
    {
        $response['message']= "Please Fill All Field";
        $response['status_code'] = 400;
        echo json_encode($response);
    }
?>