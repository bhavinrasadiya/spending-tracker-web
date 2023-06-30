<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
    $data = json_decode(file_get_contents('php://input'), true);
    $group_id=$data['group_id'];
	$group_name=$data['group_name'];
	$password=$data['password'];
    $cn=@mysql_connect("localhost","root","");
    $db=mysql_select_db("spending_tracker",$cn);
    $q="update groups_detail set  group_name='$group_name',password='$password' where group_id='$group_id'";
    $expenses = array();
    $result=mysql_query("$q",$cn);
    while($row =mysql_fetch_assoc($result))
    {    
        array_push($expenses,$row);  
    }
    $response['message']="Success";
    $response['status_code'] = 200;
    $response['data'] = $expenses;
    echo json_encode($response);
 ?>