<?php
   header('Access-Control-Allow-Origin: *');
   header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
   header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
    $data = json_decode(file_get_contents('php://input'), true);

    $group_id=$data['group_id'];
    $password=$data['password'];

    if(!empty($group_id) && !empty($password))
    {
        $cn=@mysql_connect("localhost","root","");
        $db=mysql_select_db("spending_tracker",$cn);
        $q="select * from groups_detail where group_id='$group_id' and Password='$password'";
        $result=mysql_query("$q",$cn);
       
        if(mysql_num_rows($result)>0)
            {
                while($r = mysql_fetch_assoc($result)) {
                    $rows['group_detail'][] = $r;
                }
                $response['message']= "login Successfully";
                $response['group_detail'] = $rows;
                $response['status_code'] = 200;
                echo json_encode($response);
            }
            else
            {
                $response['message']= "Enter Valid Group id and Password";
                $response['status_code'] = 403;
                echo json_encode($response);

            } 
    }  
    else{
    
        $response['message']= "Please fill all Field";
        $response['status_code'] = 400;
        echo json_encode($response);

    }
?>