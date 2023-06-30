<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

    $data = json_decode(file_get_contents('php://input'), true);
    
    $group_id=$data['group_id'];
    $minDate=$data['minDate'];
    $maxDate=$data['maxDate'];

    if(!empty($group_id))
    {
        $cn=@mysql_connect("localhost","root","");
        $db=mysql_select_db("spending_tracker",$cn);
        $q="SELECT expense.id,expense.description,expense.amount,friend_detail.frd_name,expense.date FROM expense INNER JOIN friend_detail ON friend_detail.frd_id=expense.payer WHERE expense.date between '$minDate' and '$maxDate'"; 
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
}   

?>