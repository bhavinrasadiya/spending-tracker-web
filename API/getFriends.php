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
        $q="SELECT group_member.group_id,friend_detail.frd_id,friend_detail.frd_name,friend_detail.mob_no,friend_detail.email_id FROM group_member INNER JOIN friend_detail ON group_member.frd_id=friend_detail.frd_id WHERE group_member.group_id='$group_id'";
        $result=mysql_query("$q",$cn);

          if(mysql_num_rows($result)>0)
            {
                $rows = array();

                while($r = mysql_fetch_assoc($result)) {
                    $rows['friends'][] = $r;
                }

                $response['message']= "All friends list";
                $response['status_code'] = 200;
                $response['data'] = $rows;
                print json_encode($response);
            }
            else
            {
                $response['message']= "Enter Valid Group id and Password";
                $response['status_code'] = 200;
                echo json_encode($response);
            } 
    }
    else{
            $response['message']= "Please Fill All Field";
            $response['status_code'] = 200;
            echo json_encode($response);
            
        }

?>