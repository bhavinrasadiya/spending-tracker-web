<?php
    $data = json_decode(file_get_contents('php://input'), true);
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
    $group_id=$data['group_id'];
    $expenses = array();
    if(!empty($group_id))
    {
        $cn=@mysql_connect("localhost","root","");
        $db=mysql_select_db("spending_tracker",$cn);
        $q="select frd_id from group_member where group_id='$group_id'";
        $res=mysql_query("$q",$cn);
        while($row =mysql_fetch_assoc($res))
        {
            $payer=$row["frd_id"];
            $q="select expense.amount,friend_detail.frd_name from expense inner join friend_detail On friend_detail.frd_id=expense.payer where expense.payer='$payer'";
            $result=mysql_query("$q",$cn);
            $total_paid=0;
                    while($row =mysql_fetch_assoc($result))
                        {
                        $friend_paid=$row["amount"];
                        $total_paid=$total_paid+$friend_paid;
                        $frd_name=$row["frd_name"];
                        }
                    $q="select amount from expense_divide where frd_id='$payer'";
                    $result=mysql_query("$q",$cn);
                    $total_expense=0;
                    
                    while($row =mysql_fetch_assoc($result))
                        {
                        $friend_expense=$row["amount"];
                        $total_expense=$total_expense+$friend_expense;
                        }
                         
                if($total_expense>$total_paid)
                {
                    $total=$total_expense-$total_paid;
                    array_push($expenses,$total,$frd_name);  

                    // $response['message']= "$frd_name Paid : $total";
                    // print json_encode($response);

                }
                else
                {

                    $total=$total_paid-$total_expense;
                    array_push($expenses,$total,$frd_name);  
                    // $response['message']= "$frd_name owns: $total";
                    // print json_encode($response);
                }
            }
            $response['message']="Success";
    $response['status_code'] = 200;
    $response['data'] = $expenses;
    echo json_encode($response);
    }
?>