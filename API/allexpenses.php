<?php
    $data = json_decode(file_get_contents('php://input'), true);
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
    $group_id=$data['group_id'];
    $expenses = array();
    $friends = array();
    $allExpenses = array();
    if(!empty($group_id))
    {
        $cn=@mysql_connect("localhost","root","");
        $db=mysql_select_db("spending_tracker",$cn);
        
        /* Get All Friends */
        $q="select * from group_member inner join friend_detail on group_member.frd_id=friend_detail.frd_id where group_id='$group_id'";
        $res=mysql_query("$q",$cn);
        while($row =mysql_fetch_assoc($res))
        {
            $id = $row['frd_id'];
            $queryForExpense = "select sum(amount) as totalExpense from expense_divide where frd_id='$id' and group_id='$group_id'";
            $result=mysql_fetch_assoc(mysql_query("$queryForExpense",$cn));
            $queryFroPay = "select sum(amount) as totalPay from expense where payer='$id' and group_id='$group_id'";
            $resultForPay=mysql_fetch_assoc(mysql_query("$queryFroPay",$cn));
            $friend['name'] = $row['frd_name'];
            $friend['totalExpense'] = $result['totalExpense'];
            $friend['totalPay'] = $resultForPay['totalPay'];
            array_push($friends,$friend);
        }
        $response['data'] = $friends;
        echo json_encode($response);

        /* Get All Expenses */
        $q="select * from expense where group_id='$group_id'";
        $res=mysql_query("$q",$cn);
        while($row =mysql_fetch_assoc($res))
        {
            array_push($allExpenses,$row);
        }
        

        

    // $response['message']="Success";
    // $response['status_code'] = 200;
    // $response['data'] = $expenses;
    // echo json_encode($response);
    }
?>