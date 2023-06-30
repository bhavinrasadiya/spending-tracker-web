<?php
    $data = json_decode(file_get_contents('php://input'), true);
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

    $amount=$data['amount'];
    $description=$data['description'];
    $payer=$data['payer'];
    $group_id=$data['group_id'];
    $friends=$data['friends_to_devide'];
    $date=date("Y/m/d");
     if(!empty($amount) && !empty($description) && !empty($payer) && !empty($group_id))
    {
        $cn=@mysql_connect("localhost","root","");
        $db=mysql_select_db("spending_tracker",$cn);
        $q="insert into expense(amount,description,payer,group_id,date) values ($amount,'$description',$payer,'$group_id','$date')";
        mysql_query($q,$cn);
        $exp_id = mysql_insert_id();
        $query_string = '';
        $c=count($friends);
        $exp_amount_frd=$amount/$c;

            for ($i = 0;$i<$c; $i++) {

                if($c==0)
                {
                $query_string = $query_string."($exp_id,$exp_amount_frd,'$group_id',$friends[$i])";
                }
                elseif($i==count($friends)-1)
                {
                    $query_string = $query_string."($exp_id,$exp_amount_frd,'$group_id',$friends[$i])";
                }
                else
                {
                    $query_string = $query_string."($exp_id,$exp_amount_frd,'$group_id',$friends[$i]),";
                }  
            }

        $q1="insert into expense_divide(exp_id,amount,group_id,frd_id) values $query_string";
        // echo $q1;
        mysql_query($q1,$cn);

        $response['message']= "Expense added Successfully";
        $response['status_code'] = 200;
        echo json_encode($response);
        }

    else{
        
        $response['message']= "Please Fill All Field";
        $response['status_code'] = 200;
        echo json_encode($response);
    }
?>