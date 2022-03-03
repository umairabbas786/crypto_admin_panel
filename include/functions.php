<?php
    function ValidateLogin($email,$password,$conn)
    {
        $sql = "select * from admin where email = '$email' and password = '$password'";
        $r = $conn->query($sql);
        return (mysqli_num_rows($r));
    }
    function GetTotalTickets($conn){
        $sql = "select count(id) from ticket";
        $r = $conn->query($sql);
        $row = mysqli_fetch_assoc($r);
        return $row['count(id)'];
    }
    function KycRequests($conn){
        $sql = "select count(id) from kyc where status = '0'";
        $r = $conn->query($sql);
        $row = mysqli_fetch_assoc($r);
        $sql1 = "select count(id) from address_kyc where status = '0'";
        $r1 = $conn->query($sql1);
        $row1 = mysqli_fetch_assoc($r1);
        return $row['count(id)'] + $row1['count(id)'];
    }
    function GetUsersBalance($conn){
        $sql="SELECT sum(price) from withdraw where status='0' || status='1'";
        $result=$conn->query($sql);
        $row= mysqli_fetch_assoc($result);
        $withdraw_price=$row['sum(price)'];

        $sql1="SELECT sum(price) from deposit WHERE status='1'";
        $result1=$conn->query($sql1);
        $row1= mysqli_fetch_assoc($result1);
        $total_sum=$row1['sum(price)'];
        $total_price=$total_sum-$withdraw_price;
        return $total_price;
    }
    function AdminStatusCheck($email,$conn){
        $sql = "select status from admin where email = '$email'";
        $r = $conn->query($sql);
        $row = mysqli_fetch_assoc($r);
        if($row['status'] == '1'){
            return false;
        }
        else{
            return true;
        }
    }
    function AddAdmin($first,$last,$email,$pass,$conn){
        $sql = "insert into admin (first_name,last_name,email,password,status) values('$first','$last','$email','$pass','0')";
        $r = $conn->query($sql);
        if($r){
            return true;
        }
        else{
            return false;
        }
    }
    function GetOpenTicketCount($conn){
        $sql = "select count(id) from ticket where status = '1'";
        $r = $conn->query($sql);
        $row = mysqli_fetch_assoc($r);
        return $row['count(id)'];
    }
    function GetClosedTicketCount($conn){
        $sql = "select count(id) from ticket where status = '0'";
        $r = $conn->query($sql);
        $row = mysqli_fetch_assoc($r);
        return $row['count(id)'];
    }
    function GetProgressTicketCount($conn){
        $sql = "select count(id) from ticket where status = '-1'";
        $r = $conn->query($sql);
        $row = mysqli_fetch_assoc($r);
        return $row['count(id)'];
    }
    function GetHoldTicketCount($conn){
        $sql = "select count(id) from ticket where status = '-2'";
        $r = $conn->query($sql);
        $row = mysqli_fetch_assoc($r);
        return $row['count(id)'];
    }
    function GetTicketDetailsWithId($id,$conn){
        $sql = "select * from ticket where id = '$id'";
        $r = $conn->query($sql);
        $row = mysqli_fetch_assoc($r);
        return $row;
    }
    function GetAdminDetails($email,$conn){
        $sql = "select * from admin where email = '$email'";
        $r = $conn->query($sql);
        $row = mysqli_fetch_assoc($r);
        return $row;
    }
    function GetTotalUsers($conn){
        $sql = "select count(id) from user";
        $r = $conn->query($sql);
        $row = mysqli_fetch_assoc($r);
        return $row['count(id)'];
    }
    function GetUserWithId($id,$conn){
        $sql = "select * from user where id = '$id'";
        $r = $conn->query($sql);
        $row = mysqli_fetch_assoc($r);
        return $row;
    }
    function GetUserWithEmail($email,$conn){
        $sql = "select * from user where email = '$email'";
        $r = $conn->query($sql);
        $row = mysqli_fetch_assoc($r);
        return $row;
    }
    function GetUserIdWithEmail($email,$conn){
        $sql = "select id from user where email = '$email'";
        $r = $conn->query($sql);
        $row = mysqli_fetch_assoc($r);
        return $row['id'];
    }
    function GetAddressProofWithId($id,$conn){
        $sql = "select * from address_kyc where id = '$id'";
        $r = $conn->query($sql);
        $row = mysqli_fetch_assoc($r);
        return $row;
    }
    function GetIdentityProofWithId($id,$conn){
        $sql = "select * from kyc where id = '$id'";
        $r = $conn->query($sql);
        $row = mysqli_fetch_assoc($r);
        return $row;
    }
    function GetAdminWithId($id,$conn){
        $sql = "select * from admin where id = '$id'";
        $r = $conn->query($sql);
        $row = mysqli_fetch_assoc($r);
        return $row;
    }
    function UpdateUser($id,$username,$phone,$email,$email_verify,$pass,$status,$conn){
        $sql = "update user set username = '$username' , phone = '$phone' , email = '$email' , password = '$pass', email_verification = '$email_verify' , block_status = '$status' where id = '$id'";
        $r = $conn->query($sql);
        if($r){
            return true;
        }
        else{
            return false;
        }
    }
    function UpdateAddressProof($id,$status,$conn){
        $sql = "update address_kyc set status = '$status' where id = '$id'";
        $r = $conn->query($sql);
        if($r){
            return true;
        }
        else{
            return false;
        }
    }
    function UpdateIdentityProof($id,$status,$conn){
        $sql = "update kyc set status = '$status' where id = '$id'";
        $r = $conn->query($sql);
        if($r){
            return true;
        }
        else{
            return false;
        }
    }
    function UpdateAdmin($id,$first,$last,$email,$status,$conn){
        $sql = "update admin set first_name = '$first' , last_name = '$last' , email = '$email' , status = '$status' where id = '$id'";
        $r = $conn->query($sql);
        if($r){
            return true;
        }
        else{
            return false;
        }
    }
    function UpdateNews($id,$text,$conn){
        $sql = "update marquee set text = '$text' where id = '$id'";
        $r = $conn->query($sql);
        if($r){
            return true;
        }
        else{
            return false;
        }
    }
    function GetNews($conn){
        $sql = "select * from marquee";
        $r = $conn->query($sql);
        $row = mysqli_fetch_assoc($r);
        return $row;
    }
    function GetUserEmail($id,$conn){
        $sql = "select email from user where id = '$id'";
        $r = $conn->query($sql);
        $row = mysqli_fetch_assoc($r);
        return $row['email'];
    }
    function GetUserBalance($email,$conn){  
        $sql1="SELECT sum(price) FROM withdraw WHERE sender='$email' && status='0' || sender='$email' && status='1'";
        $result=$conn->query($sql1);
        $row= mysqli_fetch_assoc($result);
        $withdraw_price=$row['sum(price)'];
        $sql1="SELECT sum(price) FROM deposit WHERE sender='$email' && status='1'";
        $result1=$conn->query($sql1);
        $row1= mysqli_fetch_assoc($result1);
        $total_sum=$row1['sum(price)'];
        $total_price=$total_sum-$withdraw_price;
        return $total_price;
    }
    function GetUserActivity($conn){
        $sql = "select * from activity_log";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $row['user'] = '<a href=edituser.php?id='.GetUserIdWithEmail($row['user'],$conn).'>'.$row['user'].'</a>';
            $data[] = array(
                "id" => $row['id'],
                "date" => $row['date'],
                "user" => $row['user'],
                "ip" => $row['ip_address'],
                "browser" => $row['browser']
              );
        }
        echo json_encode($data);
    }
    function GetUserDetails($conn){
        $sql = "select * from user";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='edituser.php?id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
            $deleteButton = "<a class='btn btn-xs btn-danger' href='user.php?id=".$row['id']."'' ><i class='glyphicon glyphicon-trash'></i></a>";
            $action = $updateButton." ".$deleteButton;
            if($row['email_verification'] == '1'){
                $row['email_verification'] = '<span class="label label-success">Verified</span>';
            }
            if($row['email_verification'] == '0'){
                $row['email_verification'] = '<span class="label label-danger">Unverified</span>';
            }
            if($row['block_status'] == '1'){
                $row['block_status'] = '<span class="label label-success">Blocked</span>';
            }
            if($row['block_status'] == '0'){
                $row['block_status'] = '<span class="label label-danger">Unblocked</span>';
            }
            if($row['block_status'] == '-1'){
                $row['block_status'] = '<span class="label label-primary">Suspended</span>';
            }
            if(GetUserBalance($row['email'],$conn) < 1){
                $row['account_number'] = '$0.00';
            }
            else{
                $row['account_number'] = "$". GetUserBalance($row['email'],$conn).".00";
            }
            $data[] = array(
                "id" => $row['id'],
                "username" => $row['username'],
                "email" => $row['email'],
                "phone" => $row['phone'],
                "balance" => $row['account_number'],
                "account_type" => $row['account_type'],
                "password" => $row['password'],
                "email_verification" => $row['email_verification'],
                "block_status" => $row['block_status'],
                "action" => $action
              );
        }
        echo json_encode($data);
    }
    function UserTransactionCheck($email,$conn){
        $sql = "select * from transection where sender='$email'";
        $r = $conn->query($sql);
        if(mysqli_num_rows($r) >= 1){
            return true;
        }
        else{
            return false;
        }
    }
    function UserTicketCheck($email,$conn){
        $sql = "select * from ticket where owner='$email'";
        $r = $conn->query($sql);
        if(mysqli_num_rows($r) >= 1){
            return true;
        }
        else{
            return false;
        }
    }
    function AddressCheck($conn){
        $sql = "select * from address_kyc";
        $r = $conn->query($sql);
        if(mysqli_num_rows($r) >= 1){
            return true;
        }
        else{
            return false;
        }
    }
    function GetTransactionWithId($id,$conn){
        $sql = "select * from transection where id='$id'";
        $r = $conn->query($sql);
        $row = mysqli_fetch_assoc($r);
        return $row;
    }
    function GetUserTransactionDetails($email,$conn){
        $sql = "select * from transection where sender='$email'";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='edittransaction.php?id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
            $action = $updateButton;
            if($row['status'] == '0'){
                $row['status'] = '<span class="label label-primary">Pending</span>';
            }
            if($row['status'] == '-1'){
                $row['status'] = '<span class="label label-danger">Cancelled</span>';
            }
            if($row['status'] == '1'){
                $row['status'] = '<span class="label label-success">Success</span>';
            }
            if($row['method'] == 'Withdraw'){
                $row['price'] = '<span class="text-danger">- $'.$row['price'].'</span>';
            }
            if($row['method'] == 'Fund Wallet'){
                $row['price'] = '<span class="text-success">+ $'.$row['price'].'</span>';
            }
            if($row['method'] == 'Sender'){
                $row['price'] = '<span class="text-danger">- $'.$row['price'].'</span>';
            }
            if($row['method'] == 'Reciever'){
                $row['price'] = '<span class="text-success">+ $'.$row['price'].'</span>';
            }
            $row['sender'] = '<a href=edituser.php?id='.GetUserIdWithEmail($row['sender'],$conn).'>'.$row['sender'].'</a>';
            $data[] = array(
                "id" => $row['id'],
                "transection_id" => $row['transection_id'],
                "user" => $row['sender'],
                "amount" => $row['price'],
                "type" => $row['method'],
                "status" => $row['status'],
                "date" => $row['date'],
                "action" => $action
              );
        }
        echo json_encode($data);
    }
    function GetAllTransaction($conn){
        $sql = "select * from transection";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='edittransaction.php?id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
            $action = $updateButton;
            if($row['status'] == '0'){
                $row['status'] = '<span class="label label-primary">Pending</span>';
            }
            if($row['status'] == '-1'){
                $row['status'] = '<span class="label label-danger">Cancelled</span>';
            }
            if($row['status'] == '1'){
                $row['status'] = '<span class="label label-success">Success</span>';
            }
            if($row['method'] == 'Withdraw'){
                $row['price'] = '<span class="text-danger">- $'.$row['price'].'</span>';
            }
            if($row['method'] == 'Fund Wallet'){
                $row['price'] = '<span class="text-success">+ $'.$row['price'].'</span>';
            }
            if($row['method'] == 'Sender'){
                $row['price'] = '<span class="text-danger">- $'.$row['price'].'</span>';
            }
            if($row['method'] == 'Reciever'){
                $row['price'] = '<span class="text-success">+ $'.$row['price'].'</span>';
            }
            $row['sender'] = '<a href=edituser.php?id='.GetUserIdWithEmail($row['sender'],$conn).'>'.$row['sender'].'</a>';
            $data[] = array(
                "id" => $row['id'],
                "transection_id" => $row['transection_id'],
                "user" => $row['sender'],
                "amount" => $row['price'],
                "type" => $row['method'],
                "status" => $row['status'],
                "date" => $row['date'],
                "action" => $action
              );
        }
        echo json_encode($data);
    }
    function GetPendingTransaction($conn){
        $sql = "select * from transection where status = '0'";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='edittransaction.php?id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
            $action = $updateButton;
            if($row['status'] == '0'){
                $row['status'] = '<span class="label label-primary">Pending</span>';
            }
            if($row['status'] == '-1'){
                $row['status'] = '<span class="label label-danger">Cancelled</span>';
            }
            if($row['status'] == '1'){
                $row['status'] = '<span class="label label-success">Success</span>';
            }
            if($row['method'] == 'Withdraw'){
                $row['price'] = '<span class="text-danger">- $'.$row['price'].'</span>';
            }
            if($row['method'] == 'Fund Wallet'){
                $row['price'] = '<span class="text-success">+ $'.$row['price'].'</span>';
            }
            if($row['method'] == 'Sender'){
                $row['price'] = '<span class="text-danger">- $'.$row['price'].'</span>';
            }
            if($row['method'] == 'Reciever'){
                $row['price'] = '<span class="text-success">+ $'.$row['price'].'</span>';
            }
            $row['sender'] = '<a href=edituser.php?id='.GetUserIdWithEmail($row['sender'],$conn).'>'.$row['sender'].'</a>';
            $data[] = array(
                "id" => $row['id'],
                "transection_id" => $row['transection_id'],
                "user" => $row['sender'],
                "amount" => $row['price'],
                "type" => $row['method'],
                "status" => $row['status'],
                "date" => $row['date'],
                "action" => $action
              );
        }
        echo json_encode($data);
    }
    function GetSuccessTransaction($conn){
        $sql = "select * from transection where status = '1'";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='edittransaction.php?id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
            $action = $updateButton;
            if($row['status'] == '0'){
                $row['status'] = '<span class="label label-primary">Pending</span>';
            }
            if($row['status'] == '-1'){
                $row['status'] = '<span class="label label-danger">Cancelled</span>';
            }
            if($row['status'] == '1'){
                $row['status'] = '<span class="label label-success">Success</span>';
            }
            if($row['method'] == 'Withdraw'){
                $row['price'] = '<span class="text-danger">- $'.$row['price'].'</span>';
            }
            if($row['method'] == 'Fund Wallet'){
                $row['price'] = '<span class="text-success">+ $'.$row['price'].'</span>';
            }
            if($row['method'] == 'Sender'){
                $row['price'] = '<span class="text-danger">- $'.$row['price'].'</span>';
            }
            if($row['method'] == 'Reciever'){
                $row['price'] = '<span class="text-success">+ $'.$row['price'].'</span>';
            }
            $row['sender'] = '<a href=edituser.php?id='.GetUserIdWithEmail($row['sender'],$conn).'>'.$row['sender'].'</a>';
            $data[] = array(
                "id" => $row['id'],
                "transection_id" => $row['transection_id'],
                "user" => $row['sender'],
                "amount" => $row['price'],
                "type" => $row['method'],
                "status" => $row['status'],
                "date" => $row['date'],
                "action" => $action
              );
        }
        echo json_encode($data);
    }
    function GetCancelledTransaction($conn){
        $sql = "select * from transection where status = '-1'";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='edittransaction.php?id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
            $action = $updateButton;
            if($row['status'] == '0'){
                $row['status'] = '<span class="label label-primary">Pending</span>';
            }
            if($row['status'] == '-1'){
                $row['status'] = '<span class="label label-danger">Cancelled</span>';
            }
            if($row['status'] == '1'){
                $row['status'] = '<span class="label label-success">Success</span>';
            }
            if($row['method'] == 'Withdraw'){
                $row['price'] = '<span class="text-danger">- $'.$row['price'].'</span>';
            }
            if($row['method'] == 'Fund Wallet'){
                $row['price'] = '<span class="text-success">+ $'.$row['price'].'</span>';
            }
            if($row['method'] == 'Sender'){
                $row['price'] = '<span class="text-danger">- $'.$row['price'].'</span>';
            }
            if($row['method'] == 'Reciever'){
                $row['price'] = '<span class="text-success">+ $'.$row['price'].'</span>';
            }
            $row['sender'] = '<a href=edituser.php?id='.GetUserIdWithEmail($row['sender'],$conn).'>'.$row['sender'].'</a>';
            $data[] = array(
                "id" => $row['id'],
                "transection_id" => $row['transection_id'],
                "user" => $row['sender'],
                "amount" => $row['price'],
                "type" => $row['method'],
                "status" => $row['status'],
                "date" => $row['date'],
                "action" => $action
              );
        }
        echo json_encode($data);
    }
    function GetDepositWithId($id,$conn){
        $sql = "select * from deposit where id = '$id'";
        $r = $conn->query($sql);
        $row = mysqli_fetch_array($r);
        return $row;
    }
    function GetPayoutWithId($id,$conn){
        $sql = "select * from payout where id = '$id'";
        $r = $conn->query($sql);
        $row = mysqli_fetch_array($r);
        return $row;
    }
    function GetWithdrawWithId($id,$conn){
        $sql = "select * from withdraw where id = '$id'";
        $r = $conn->query($sql);
        $row = mysqli_fetch_array($r);
        return $row;
    }
    function GetAllDeposit($conn){
        $sql = "select * from deposit";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='editdeposit.php?id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
            $action = $updateButton;
            if($row['status'] == '0'){
                $row['status'] = '<span class="label label-primary">Pending</span>';
            }
            if($row['status'] == '-1'){
                $row['status'] = '<span class="label label-danger">Cancelled</span>';
            }
            if($row['status'] == '1'){
                $row['status'] = '<span class="label label-success">Success</span>';
            }
            $row['price'] = '<span class="text-success">+ $'.$row['price'].'</span>';
            $row['sender'] = '<a href=edituser.php?id='.GetUserIdWithEmail($row['sender'],$conn).'>'.$row['sender'].'</a>';
            $data[] = array(
                "id" => $row['id'],
                "user" => $row['sender'],
                "amount" => $row['price'],
                "method" => $row['method'],
                "status" => $row['status'],
                // "date" => $row['date'],
                "action" => $action
              );
        }
        echo json_encode($data);
    }
    function GetPendingDeposit($conn){
        $sql = "select * from deposit where status = '0'";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='editdeposit.php?id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
            $action = $updateButton;
            if($row['status'] == '0'){
                $row['status'] = '<span class="label label-primary">Pending</span>';
            }
            if($row['status'] == '-1'){
                $row['status'] = '<span class="label label-danger">Cancelled</span>';
            }
            if($row['status'] == '1'){
                $row['status'] = '<span class="label label-success">Success</span>';
            }
            $row['price'] = '<span class="text-success">+ $'.$row['price'].'</span>';
            $row['sender'] = '<a href=edituser.php?id='.GetUserIdWithEmail($row['sender'],$conn).'>'.$row['sender'].'</a>';
            $data[] = array(
                "id" => $row['id'],
                "user" => $row['sender'],
                "amount" => $row['price'],
                "method" => $row['method'],
                "status" => $row['status'],
                // "date" => $row['date'],
                "action" => $action
              );
        }
        echo json_encode($data);
    }
    function GetSuccessDeposit($conn){
        $sql = "select * from deposit where status = '1'";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='editdeposit.php?id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
            $action = $updateButton;
            if($row['status'] == '0'){
                $row['status'] = '<span class="label label-primary">Pending</span>';
            }
            if($row['status'] == '-1'){
                $row['status'] = '<span class="label label-danger">Cancelled</span>';
            }
            if($row['status'] == '1'){
                $row['status'] = '<span class="label label-success">Success</span>';
            }
            $row['price'] = '<span class="text-success">+ $'.$row['price'].'</span>';
            $row['sender'] = '<a href=edituser.php?id='.GetUserIdWithEmail($row['sender'],$conn).'>'.$row['sender'].'</a>';
            $data[] = array(
                "id" => $row['id'],
                "user" => $row['sender'],
                "amount" => $row['price'],
                "method" => $row['method'],
                "status" => $row['status'],
                // "date" => $row['date'],
                "action" => $action
              );
        }
        echo json_encode($data);
    }
    function GetCancelledDeposit($conn){
        $sql = "select * from deposit where status = '-1'";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='editdeposit.php?id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
            $action = $updateButton;
            if($row['status'] == '0'){
                $row['status'] = '<span class="label label-primary">Pending</span>';
            }
            if($row['status'] == '-1'){
                $row['status'] = '<span class="label label-danger">Cancelled</span>';
            }
            if($row['status'] == '1'){
                $row['status'] = '<span class="label label-success">Success</span>';
            }
            $row['price'] = '<span class="text-success">+ $'.$row['price'].'</span>';
            $row['sender'] = '<a href=edituser.php?id='.GetUserIdWithEmail($row['sender'],$conn).'>'.$row['sender'].'</a>';
            $data[] = array(
                "id" => $row['id'],
                "user" => $row['sender'],
                "amount" => $row['price'],
                "method" => $row['method'],
                "status" => $row['status'],
                // "date" => $row['date'],
                "action" => $action
              );
        }
        echo json_encode($data);
    }
    function GetAllWithdraw($conn){
        $sql = "select * from withdraw";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='editwithdraw.php?id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
            $action = $updateButton;
            if($row['status'] == '0'){
                $row['status'] = '<span class="label label-primary">Pending</span>';
            }
            if($row['status'] == '-1'){
                $row['status'] = '<span class="label label-danger">Cancelled</span>';
            }
            if($row['status'] == '1'){
                $row['status'] = '<span class="label label-success">Success</span>';
            }
            $row['price'] = '<span class="text-danger">- $'.$row['price'].'</span>';
            $row['sender'] = '<a href=edituser.php?id='.GetUserIdWithEmail($row['sender'],$conn).'>'.$row['sender'].'</a>';
            $rrr = GetPayoutWithId($row['details'],$conn);
            if(empty($rrr['type'])){
                $type = '';
            }else{
                $type = $rrr['type'];
            }
            if(empty($rrr['details'])){
                $detail = '';
            }else{
                $detail = $rrr['details'];
            }
            $data[] = array(
                "id" => $row['id'],
                "user" => $row['sender'],
                "amount" => $row['price'],
                "type" => $type,
                "method" => $detail,
                "status" => $row['status'],
                // "date" => $row['date'],
                "action" => $action
              );
        }
        echo json_encode($data);
    }
    function GetPendingWithdraw($conn){
        $sql = "select * from withdraw where status = '0'";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='editwithdraw.php?id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
            $action = $updateButton;
            if($row['status'] == '0'){
                $row['status'] = '<span class="label label-primary">Pending</span>';
            }
            if($row['status'] == '-1'){
                $row['status'] = '<span class="label label-danger">Cancelled</span>';
            }
            if($row['status'] == '1'){
                $row['status'] = '<span class="label label-success">Success</span>';
            }
            $row['price'] = '<span class="text-danger">- $'.$row['price'].'</span>';
            $row['sender'] = '<a href=edituser.php?id='.GetUserIdWithEmail($row['sender'],$conn).'>'.$row['sender'].'</a>';
            $rrr = GetPayoutWithId($row['details'],$conn);
            if(empty($rrr['type'])){
                $type = '';
            }else{
                $type = $rrr['type'];
            }
            if(empty($rrr['details'])){
                $detail = '';
            }else{
                $detail = $rrr['details'];
            }
            $data[] = array(
                "id" => $row['id'],
                "user" => $row['sender'],
                "amount" => $row['price'],
                "type" => $type,
                "method" => $detail,
                "status" => $row['status'],
                // "date" => $row['date'],
                "action" => $action
              );
        }
        echo json_encode($data);
    }
    function GetSuccessWithdraw($conn){
        $sql = "select * from withdraw where status = '1'";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='editwithdraw.php?id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
            $action = $updateButton;
            if($row['status'] == '0'){
                $row['status'] = '<span class="label label-primary">Pending</span>';
            }
            if($row['status'] == '-1'){
                $row['status'] = '<span class="label label-danger">Cancelled</span>';
            }
            if($row['status'] == '1'){
                $row['status'] = '<span class="label label-success">Success</span>';
            }
            $row['price'] = '<span class="text-danger">- $'.$row['price'].'</span>';
            $row['sender'] = '<a href=edituser.php?id='.GetUserIdWithEmail($row['sender'],$conn).'>'.$row['sender'].'</a>';
            $rrr = GetPayoutWithId($row['details'],$conn);
            if(empty($rrr['type'])){
                $type = '';
            }else{
                $type = $rrr['type'];
            }
            if(empty($rrr['details'])){
                $detail = '';
            }else{
                $detail = $rrr['details'];
            }
            $data[] = array(
                "id" => $row['id'],
                "user" => $row['sender'],
                "amount" => $row['price'],
                "type" => $type,
                "method" => $detail,
                "status" => $row['status'],
                // "date" => $row['date'],
                "action" => $action
              );
        }
        echo json_encode($data);
    }
    function GetCancelledWithdraw($conn){
        $sql = "select * from withdraw where status = '-1'";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='editwithdraw.php?id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
            $action = $updateButton;
            if($row['status'] == '0'){
                $row['status'] = '<span class="label label-primary">Pending</span>';
            }
            if($row['status'] == '-1'){
                $row['status'] = '<span class="label label-danger">Cancelled</span>';
            }
            if($row['status'] == '1'){
                $row['status'] = '<span class="label label-success">Success</span>';
            }
            $row['price'] = '<span class="text-danger">- $'.$row['price'].'</span>';
            $row['sender'] = '<a href=edituser.php?id='.GetUserIdWithEmail($row['sender'],$conn).'>'.$row['sender'].'</a>';
            $rrr = GetPayoutWithId($row['details'],$conn);
            if(empty($rrr['type'])){
                $type = '';
            }else{
                $type = $rrr['type'];
            }
            if(empty($rrr['details'])){
                $detail = '';
            }else{
                $detail = $rrr['details'];
            }
            $data[] = array(
                "id" => $row['id'],
                "user" => $row['sender'],
                "amount" => $row['price'],
                "type" => $type,
                "method" => $detail,
                "status" => $row['status'],
                // "date" => $row['date'],
                "action" => $action
              );
        }
        echo json_encode($data);
    }
    function GetAllTransfers($conn){
        $sql = "select * from wallet_history";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $deleteButton = "<a class='btn btn-xs btn-danger' href='transfers.php?id=".$row['id']."'' ><i class='glyphicon glyphicon-trash'></i></a>";
            $action = $deleteButton;
            $row['price'] = '<span class="text-danger">- $'.$row['price'].'</span>';
            $row['sender'] = '<a href=edituser.php?id='.GetUserIdWithEmail($row['sender'],$conn).'>'.$row['sender'].'</a>';
            $data[] = array(
                "id" => $row['id'],
                "date" => $row['date'],
                "user" => $row['sender'],
                "amount" => $row['price'],
                "receiver" => $row['receiver'],
                "note" => $row['description'],
                "action" => $action
              );
        }
        echo json_encode($data);
    }
    function GetAllTickets($conn){
        $sql = "select * from ticket";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='ticketreply.php?id=".$row['id']."'' ><i class='glyphicon glyphicon-send'></i></a>";
            $deleteButton = "<a class='btn btn-xs btn-danger' href='ticket.php?id=".$row['id']."'' ><i class='glyphicon glyphicon-trash'></i></a>";
            $action = $updateButton.' '.$deleteButton;
            if($row['status'] == '1'){
                $row['status'] = '<span class="label label-success">Open</span>';
            }
            if($row['status'] == '0'){
                $row['status'] = '<span class="label label-danger">Closed</span>';
            }
            if($row['status'] == '-1'){
                $row['status'] = '<span class="label label-primary">In Progress</span>';
            }
            if($row['status'] == '-2'){
                $row['status'] = '<span class="label label-warning">Hold</span>';
            }
            $row['owner'] = '<a href=edituser.php?id='.GetUserIdWithEmail($row['owner'],$conn).'>'.$row['owner'].'</a>';
            $data[] = array(
                "id" => $row['id'],
                "date" => $row['date'],
                "user" => $row['owner'],
                "subject" => $row['subject'],
                "status" => $row['status'],
                "priority" => $row['type'],
                "action" => $action
              );
        }
        echo json_encode($data);
    }
    function GetUserTickets($email,$conn){
        $sql = "select * from ticket where owner = '$email'";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='ticketreply.php?id=".$row['id']."'' ><i class='glyphicon glyphicon-send'></i></a>";
            $deleteButton = "<a class='btn btn-xs btn-danger' href='ticket.php?id=".$row['id']."'' ><i class='glyphicon glyphicon-trash'></i></a>";
            $action = $updateButton.' '.$deleteButton;
            if($row['status'] == '1'){
                $row['status'] = '<span class="label label-success">Open</span>';
            }
            if($row['status'] == '0'){
                $row['status'] = '<span class="label label-danger">Closed</span>';
            }
            if($row['status'] == '-1'){
                $row['status'] = '<span class="label label-primary">In Progress</span>';
            }
            if($row['status'] == '-2'){
                $row['status'] = '<span class="label label-warning">Hold</span>';
            }
            $row['owner'] = '<a href=edituser.php?id='.GetUserIdWithEmail($row['owner'],$conn).'>'.$row['owner'].'</a>';
            $data[] = array(
                "id" => $row['id'],
                "date" => $row['date'],
                "user" => $row['owner'],
                "subject" => $row['subject'],
                "status" => $row['status'],
                "priority" => $row['type'],
                "action" => $action
              );
        }
        echo json_encode($data);
    }
    function GetAllAddressProofs($conn){
        $sql = "select * from address_kyc";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='editaddressverification.php?id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
            $action = $updateButton;
            if($row['status'] == '0'){
                $row['status'] = '<span class="label label-success">Pending</span>';
            }
            if($row['status'] == '1'){
                $row['status'] = '<span class="label label-primary">Approved</span>';
            }
            if($row['status'] == '-1'){
                $row['status'] = '<span class="label label-danger">Rejected</span>';
            }
            $row['email'] = '<a href=edituser.php?id='.GetUserIdWithEmail($row['email'],$conn).'>'.$row['email'].'</a>';
            $data[] = array(
                "id" => $row['id'],
                "date" => $row['date'],
                "email" => $row['email'],
                "status" => $row['status'],
                "action" => $action
              );
        }
        echo json_encode($data);
    }
    function GetPendingAddressProofs($conn){
        $sql = "select * from address_kyc where status = 0";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='editaddressverification.php?id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
            $action = $updateButton;
            if($row['status'] == '0'){
                $row['status'] = '<span class="label label-success">Pending</span>';
            }
            if($row['status'] == '1'){
                $row['status'] = '<span class="label label-primary">Approved</span>';
            }
            if($row['status'] == '-1'){
                $row['status'] = '<span class="label label-danger">Rejected</span>';
            }
            $row['email'] = '<a href=edituser.php?id='.GetUserIdWithEmail($row['email'],$conn).'>'.$row['email'].'</a>';
            $data[] = array(
                "id" => $row['id'],
                "date" => $row['date'],
                "email" => $row['email'],
                "status" => $row['status'],
                "action" => $action
              );
        }
        echo json_encode($data);
    }
    function GetApprovedAddressProofs($conn){
        $sql = "select * from address_kyc where status = 1";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='editaddressverification.php?id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
            $action = $updateButton;
            if($row['status'] == '0'){
                $row['status'] = '<span class="label label-success">Pending</span>';
            }
            if($row['status'] == '1'){
                $row['status'] = '<span class="label label-primary">Approved</span>';
            }
            if($row['status'] == '-1'){
                $row['status'] = '<span class="label label-danger">Rejected</span>';
            }
            $row['email'] = '<a href=edituser.php?id='.GetUserIdWithEmail($row['email'],$conn).'>'.$row['email'].'</a>';
            $data[] = array(
                "id" => $row['id'],
                "date" => $row['date'],
                "email" => $row['email'],
                "status" => $row['status'],
                "action" => $action
              );
        }
        echo json_encode($data);
    }
    function GetRejectedAddressProofs($conn){
        $sql = "select * from address_kyc where status = -1";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='editaddressverification.php?id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
            $action = $updateButton;
            if($row['status'] == '0'){
                $row['status'] = '<span class="label label-success">Pending</span>';
            }
            if($row['status'] == '1'){
                $row['status'] = '<span class="label label-primary">Approved</span>';
            }
            if($row['status'] == '-1'){
                $row['status'] = '<span class="label label-danger">Rejected</span>';
            }
            $row['email'] = '<a href=edituser.php?id='.GetUserIdWithEmail($row['email'],$conn).'>'.$row['email'].'</a>';
            $data[] = array(
                "id" => $row['id'],
                "date" => $row['date'],
                "email" => $row['email'],
                "status" => $row['status'],
                "action" => $action
              );
        }
        echo json_encode($data);
    }
    function GetAllIdentityProofs($conn){
        $sql = "select * from kyc";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='editidentityverification.php?id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
            $action = $updateButton;
            if($row['status'] == '0'){
                $row['status'] = '<span class="label label-success">Pending</span>';
            }
            if($row['status'] == '1'){
                $row['status'] = '<span class="label label-primary">Approved</span>';
            }
            if($row['status'] == '-1'){
                $row['status'] = '<span class="label label-danger">Rejected</span>';
            }
            $row['email'] = '<a href=edituser.php?id='.GetUserIdWithEmail($row['email'],$conn).'>'.$row['email'].'</a>';
            $data[] = array(
                "id" => $row['id'],
                "date" => $row['date'],
                "email" => $row['email'],
                "status" => $row['status'],
                "action" => $action
              );
        }
        echo json_encode($data);
    }
    function GetPendingIdentityProofs($conn){
        $sql = "select * from kyc where status = 0";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='editidentityverification.php?id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
            $action = $updateButton;
            if($row['status'] == '0'){
                $row['status'] = '<span class="label label-success">Pending</span>';
            }
            if($row['status'] == '1'){
                $row['status'] = '<span class="label label-primary">Approved</span>';
            }
            if($row['status'] == '-1'){
                $row['status'] = '<span class="label label-danger">Rejected</span>';
            }
            $row['email'] = '<a href=edituser.php?id='.GetUserIdWithEmail($row['email'],$conn).'>'.$row['email'].'</a>';
            $data[] = array(
                "id" => $row['id'],
                "date" => $row['date'],
                "email" => $row['email'],
                "status" => $row['status'],
                "action" => $action
              );
        }
        echo json_encode($data);
    }
    function GetApprovedIdentityProofs($conn){
        $sql = "select * from kyc where status = 1";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='editidentityverification.php?id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
            $action = $updateButton;
            if($row['status'] == '0'){
                $row['status'] = '<span class="label label-success">Pending</span>';
            }
            if($row['status'] == '1'){
                $row['status'] = '<span class="label label-primary">Approved</span>';
            }
            if($row['status'] == '-1'){
                $row['status'] = '<span class="label label-danger">Rejected</span>';
            }
            $row['email'] = '<a href=edituser.php?id='.GetUserIdWithEmail($row['email'],$conn).'>'.$row['email'].'</a>';
            $data[] = array(
                "id" => $row['id'],
                "date" => $row['date'],
                "email" => $row['email'],
                "status" => $row['status'],
                "action" => $action
              );
        }
        echo json_encode($data);
    }
    function GetRejectedIdentityProofs($conn){
        $sql = "select * from kyc where status = -1";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='editidentityverification.php?id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
            $action = $updateButton;
            if($row['status'] == '0'){
                $row['status'] = '<span class="label label-success">Pending</span>';
            }
            if($row['status'] == '1'){
                $row['status'] = '<span class="label label-primary">Approved</span>';
            }
            if($row['status'] == '-1'){
                $row['status'] = '<span class="label label-danger">Rejected</span>';
            }
            $row['email'] = '<a href=edituser.php?id='.GetUserIdWithEmail($row['email'],$conn).'>'.$row['email'].'</a>';
            $data[] = array(
                "id" => $row['id'],
                "date" => $row['date'],
                "email" => $row['email'],
                "status" => $row['status'],
                "action" => $action
              );
        }
        echo json_encode($data);
    }
    function GetAdmins($email,$conn){
        $sql = "select * from admin where email!='$email' and email!='admin@gmail.com'";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='editadmin.php?id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
            $deleteButton = "<a class='btn btn-xs btn-danger' href='admin.php?id=".$row['id']."'' ><i class='glyphicon glyphicon-trash'></i></a>";
            $action = $updateButton." ".$deleteButton;
            if($row['status'] == '0'){
                $row['status'] = '<span class="label label-success">Active</span>';
            }
            if($row['status'] == '1'){
                $row['status'] = '<span class="label label-danger">Inactive</span>';
            }
            $data[] = array(
                "id" => $row['id'],
                "firstname" => $row['first_name'],
                "lastname" => $row['last_name'],
                "email" => $row['email'],
                "status" => $row['status'],
                "action" => $action
              );
        }
        echo json_encode($data);
    }
    function EmailCheck($email,$conn){
        $sql = "select * from admin where email = '$email'";
        $r = $conn->query($sql);
        return mysqli_num_rows($r);
    }
    function UnsetSession($name){
        unset($_SESSION[$name]);
    }
    function Sessionset($name){
        if(isset($_SESSION[$name])){
            return true;
        }
        else{
            return false;
        }
    }
    function CheckGet($name){
        if(isset($_GET[$name])){
            return true;
        }
        else{
            return false;
        }
    }
    function CheckPost($name){
        if(isset($_POST[$name])){
            return true;
        }
        else{
            return false;
        }
    }

?>