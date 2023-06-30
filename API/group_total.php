<?php

    $data = json_decode(file_get_contents('php://input'), true);
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
    $group_id=$data['group_id'];
    
    if(!empty($group_id))
    {
        $cn=@mysql_connect("localhost","root","");
        $db=mysql_select_db("spending_tracker",$cn);
        $q="select amount from expense where group_id='$group_id'";
        $result=mysql_query("$q",$cn);
        $a=0;

        while($row =mysql_fetch_assoc($result))
        {
           
        $b=$row["amount"];
        $a=$a+$b;        
        
        }

    }
   
    $response['status_code'] = 200;
    $response['total'] = $a;
    echo json_encode($response);

?>