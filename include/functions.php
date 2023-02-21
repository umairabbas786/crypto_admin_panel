<?php
    function siteUrl($conn){
        $s = "select * from setting where id = 1";
        $r = $conn->query($s);
        $row = mysqli_fetch_assoc($r);
        return $row['url'];
    }
    function DeleteUser($email,$conn)
    {
        $sql1 = "delete from user where email = '$email'";
        $sql2 = "delete from withdraw where sender = '$email'";
        $sql3 = "delete from transection where sender = '$email'";
        $sql4 = "delete from ticket where owner = '$email'";
        $sql5 = "delete from ticket_chat where sender = '$email'";
        $sql6 = "delete from payout where email = '$email'";
        $sql7 = "delete from cooling_period where email = '$email'";
        $sql8 = "delete from kyc where email = '$email'";
        $sql9 = "delete from deposit where sender = '$email'";
        $sql10 = "delete from address_kyc where email = '$email'";
        $sql11 = "delete from activity_log where user = '$email'";
        $sql12 = "delete from wallet_history where sender = '$email' or receiver = '$email'";
        $conn->query($sql2);$conn->query($sql3);
        $conn->query($sql4);$conn->query($sql5);
        $conn->query($sql6);$conn->query($sql7);
        $conn->query($sql8);$conn->query($sql9);
        $conn->query($sql10);$conn->query($sql11);
        $conn->query($sql12);
        $r = $conn->query($sql1);
        if($r){
            return true;
        }
        else{
            return false;
        }
    }
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
    function AddFundToUserWallet($user,$amount,$conn){
        $transection_id = mt_rand(10000,99999);
        $bal = GetUserBalance($user,$conn);
        $newbal = $bal + $amount;
        $sql1 = "update user set balance = '$newbal' where email = '$user'";
        $conn->query($sql1);
        $sql = "insert into deposit(price,sender,status,method) values ('$amount','$user','1','Administration')";
        $sql2 = "insert into transection (price,sender,method,status,date,description,transection_id) VALUES ('$amount','$user','Administration','1',now(),'Administration Credit','$transection_id')";
        $r2 = $conn->query($sql2);
        $r = $conn->query($sql);
        if($r){
            return true;
        }
        else{
            return false;
        }
    }
    function RemoveFundToUserWallet($user,$amount,$conn){
        $transection_id = mt_rand(10000,99999);
        $bal = GetUserBalance($user,$conn);
        $newbal = $bal - $amount;
        $sql1 = "update user set balance = '$newbal' where email = '$user'";
        $r = $conn->query($sql1);
        if($r){
            return true;
        }
        else{
            return false;
        }
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
        $sql="SELECT sum(balance) from user";
        $result=$conn->query($sql);
        $row= mysqli_fetch_assoc($result);
        return $row['sum(balance)'];
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
        $sql="SELECT balance from user where email = '$email'";
        $result=$conn->query($sql);
        $row= mysqli_fetch_assoc($result);
        return $row['balance'];
    }
    function GetUserActivity($conn){
        $sql = "select * from activity_log";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $row['user'] = '<a href=?a=edit-user&id='.GetUserIdWithEmail($row['user'],$conn).'>'.$row['user'].'</a>';
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
    function GetCoolingPeriod($conn){
        $sql = "select * from cooling_period";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            if($row['status'] == '1'){
                $row['status'] = '<div class="togglebutton"><label><input type="checkbox" name="status" value="'.$row['id'].'" checked=""><span class="toggle"></span></label></div>';
            }
            if($row['status'] == '0'){
                $row['status'] = '<div class="togglebutton"><label><input type="checkbox" name="statuss" value="'.$row['id'].'"><span class="toggle"></span></label></div>';
            }
            $row['email'] = '<a href=?a=edit-user&id='.GetUserIdWithEmail($row['email'],$conn).'>'.$row['email'].'</a>';
            $data[] = array(
                "id" => $row['id'],
                "email" => $row['email'],
                "status" => $row['status'],
              );
        }
        echo json_encode($data);
    }
    function CoolingPeriodStatus($id,$conn){
        $sql = "select status from cooling_period where id = '$id'";
        $r = $conn->query($sql);
        $row = mysqli_fetch_assoc($r);
        return $row['status'];
    }
    function SetCoolingPeriodStatus($id,$status,$conn){
        $sql = "update cooling_period set status = '$status' where id = '$id'";
        $r = $conn->query($sql);
        if($r){
            return true;
        }
        else{
            return false;
        }
    }
    function GetUserDetails($conn){
        $sql = "select * from user where id > 1200";
        $r = $conn->query($sql);
        $rows = array();
        $data = [];
        while($row = mysqli_fetch_array($r)){
            $id = $row['id'];
            $action = "";
            $action.= "<a class='btn btn-xs btn-primary' href='?a=edit-user&id=$id' ><i class='glyphicon glyphicon-edit'></i></a>";
            $action.= "<a class='delete' href='?a=user&id=$id' ><i class='glyphicon glyphicon-trash'></i></a>"; 
            
            if($row['email_verification'] == '1'){
                $row['email_verification'] = '<span class="label label-success">Verified</span>';
            }
            if($row['email_verification'] == '0'){
                $row['email_verification'] = '<span class="label label-danger">Unverified</span>';
            }
            if($row['block_status'] == '1'){
                $row['block_status'] = '<span class="label label-danger">Blocked</span>';
            }
            if($row['block_status'] == '0'){
                $row['block_status'] = '<span class="label label-success">Unblocked</span>';
            }
            if($row['block_status'] == '-1'){
                $row['block_status'] = '<span class="label label-primary">Suspended</span>';
            }
            if($row['balance'] < 1){
                $row['balance'] = '$0.00';
            }
            else{
                $row['balance'] = "$". $row['balance'];
            }
            $row['email'] = '<a href=?a=edit-user&id='.GetUserIdWithEmail($row['email'],$conn).'>'.$row['email'].'</a>';
          
              $data[] = [
                  'id' => $row['id'],
                  'username' => $row['username'],
                  'email' => $row['email'],
                  'balance' => $row['balance'],
                  'password' => $row['password'],
                  'email_verification' => $row['email_verification'],
                  'block_status' => $row['block_status'],
                  'action' => $action
                  ];
                
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
    function UserWalletCheck($email,$conn){
        $sql = "select * from user where email='$email'";
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
    function GetUserWalletDetails($email,$conn){
        $sql = "select balance from user where email='$email'";
        $r = $conn->query($sql);
        $rows = array();
        $row = mysqli_fetch_array($r); 
        $data[] = array(
            "id" => 1,
            "balance" => "$ ".$row['balance'],
            "currency" => "USD"
            );
        echo json_encode($data);
    }
    function GetUserTransactionDetails($email,$conn){
        $sql = "select * from transection where sender='$email'";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='?a=edit-transaction&id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
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
            if($row['method'] == 'Administration'){
                $row['price'] = '<span class="text-success">+ $'.$row['price'].'</span>';
            }
            $row['sender'] = '<a href=?a=edit-user&id='.GetUserIdWithEmail($row['sender'],$conn).'>'.$row['sender'].'</a>';
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
            $updateButton = "<a class='btn btn-xs btn-primary' href='?a=edit-transaction&id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
            $deleteButton = "<a class='btn btn-xs btn-danger' href='?a=transaction&deleteid=".$row['id']."'' ><i class='glyphicon glyphicon-trash'></i></a>";
            $action = $updateButton . ' ' . $deleteButton;
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
            if($row['method'] == 'Administration'){
                $row['price'] = '<span class="text-success">+ $'.$row['price'].'</span>';
            }
            $row['sender'] = '<a href=?a=edit-user&id='.GetUserIdWithEmail($row['sender'],$conn).'>'.$row['sender'].'</a>';
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
            $updateButton = "<a class='btn btn-xs btn-primary' href='?a=edit-transaction&id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
            $deleteButton = "<a class='btn btn-xs btn-danger' href='?a=transaction&deleteid=".$row['id']."'' ><i class='glyphicon glyphicon-trash'></i></a>";
            $action = $updateButton . ' ' . $deleteButton;
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
            if($row['method'] == 'Administration'){
                $row['price'] = '<span class="text-success">+ $'.$row['price'].'</span>';
            }
            $row['sender'] = '<a href=?a=edit-user&id='.GetUserIdWithEmail($row['sender'],$conn).'>'.$row['sender'].'</a>';
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
            $updateButton = "<a class='btn btn-xs btn-primary' href='?a=edit-transaction&id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
            $deleteButton = "<a class='btn btn-xs btn-danger' href='?a=transaction&deleteid=".$row['id']."'' ><i class='glyphicon glyphicon-trash'></i></a>";
            $action = $updateButton . ' ' . $deleteButton;
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
            if($row['method'] == 'Administration'){
                $row['price'] = '<span class="text-success">+ $'.$row['price'].'</span>';
            }
            $row['sender'] = '<a href=?a=edit-user&id='.GetUserIdWithEmail($row['sender'],$conn).'>'.$row['sender'].'</a>';
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
            $updateButton = "<a class='btn btn-xs btn-primary' href='?a=edit-transaction&id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
            $deleteButton = "<a class='btn btn-xs btn-danger' href='?a=transaction&deleteid=".$row['id']."'' ><i class='glyphicon glyphicon-trash'></i></a>";
            $action = $updateButton . ' ' . $deleteButton;
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
            if($row['method'] == 'Administration'){
                $row['price'] = '<span class="text-success">+ $'.$row['price'].'</span>';
            }
            $row['sender'] = '<a href=?a=edit-user&id='.GetUserIdWithEmail($row['sender'],$conn).'>'.$row['sender'].'</a>';
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
    function GetTransferWithId($id,$conn){
        $sql = "select * from wallet_history where id = '$id'";
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
        $sql = "select * from deposit where method !='transfer'";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='?a=edit-deposit&id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
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
            $row['sender'] = '<a href=?a=edit-user&id='.GetUserIdWithEmail($row['sender'],$conn).'>'.$row['sender'].'</a>';
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
        $sql = "select * from deposit where status = '0' and method !='transfer'";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='?a=edit-deposit&id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
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
            $row['sender'] = '<a href=?a=edit-user&id='.GetUserIdWithEmail($row['sender'],$conn).'>'.$row['sender'].'</a>';
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
        $sql = "select * from deposit where status = '1' and method !='transfer'";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='?a=edit-deposit&id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
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
            $row['sender'] = '<a href=?a=edit-user&id='.GetUserIdWithEmail($row['sender'],$conn).'>'.$row['sender'].'</a>';
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
        $sql = "select * from deposit where status = '-1' and method !='transfer'";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='?a=edit-deposit&id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
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
            $row['sender'] = '<a href=?a=edit-user&id='.GetUserIdWithEmail($row['sender'],$conn).'>'.$row['sender'].'</a>';
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
        $sql = "select * from withdraw where method != 'wallet transfer'";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='?a=edit-withdraw&id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
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
            $row['sender'] = '<a href=?a=edit-user&id='.GetUserIdWithEmail($row['sender'],$conn).'>'.$row['sender'].'</a>';
            $rrr = GetPayoutWithId($row['details'],$conn);
            if(empty($rrr['type'])){
                $type = $row['method'];
            }else{
                $type = $rrr['type'];
            }
            if(empty($rrr['details'])){
                $detail = $row['details'];
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
        $sql = "select * from withdraw where status = '0' and method != 'wallet transfer'";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='?a=edit-withdraw&id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
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
            $row['sender'] = '<a href=?a=edit-user&id='.GetUserIdWithEmail($row['sender'],$conn).'>'.$row['sender'].'</a>';
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
        $sql = "select * from withdraw where status = '1' and method != 'wallet transfer'";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='?a=edit-withdraw&id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
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
            $row['sender'] = '<a href=?a=edit-user&id='.GetUserIdWithEmail($row['sender'],$conn).'>'.$row['sender'].'</a>';
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
        $sql = "select * from withdraw where status = '-1' and method != 'wallet transfer'";
        $r = $conn->query($sql);
        $rows = array();
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='?a=edit-withdraw&id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
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
            $row['sender'] = '<a href=?a=edit-user&id='.GetUserIdWithEmail($row['sender'],$conn).'>'.$row['sender'].'</a>';
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
            $updateButton = "<a class='btn btn-xs btn-primary' href='?a=edit-transfer&id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
            $deleteButton = "<a class='btn btn-xs btn-danger' href='?a=transfer&id=".$row['id']."'' ><i class='glyphicon glyphicon-trash'></i></a>";
            $action = $updateButton . $deleteButton;
            if($row['status'] == '0'){
                $row['status'] = '<span class="label label-primary">Pending</span>';
            }
            if($row['status'] == '1'){
                $row['status'] = '<span class="label label-success">Success</span>';
            }
            $row['price'] = '<span class="text-danger">- $'.$row['price'].'</span>';
            $row['sender'] = '<a href=?a=edit-user&id='.GetUserIdWithEmail($row['sender'],$conn).'>'.$row['sender'].'</a>';
            $data[] = array(
                "id" => $row['id'],
                "date" => $row['date'],
                "user" => $row['sender'],
                "amount" => $row['price'],
                "receiver" => $row['receiver'],
                "note" => $row['description'],
                "status" => $row['status'],
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
            $updateButton = "<a class='btn btn-xs btn-primary' href='?a=ticket-reply&id=".$row['id']."'' ><i class='glyphicon glyphicon-send'></i></a>";
            $deleteButton = "<a class='btn btn-xs btn-danger' onclick='javascript:confirmationDelete($(this));return false;' href='?a=ticket&id=".$row['id']."'' ><i class='glyphicon glyphicon-trash'></i></a>";
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
            $row['owner'] = '<a href=?a=edit-user&id='.GetUserIdWithEmail($row['owner'],$conn).'>'.$row['owner'].'</a>';
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
            $updateButton = "<a class='btn btn-xs btn-primary' href='?a=ticket-reply&id=".$row['id']."'' ><i class='glyphicon glyphicon-send'></i></a>";
            $deleteButton = "<a class='btn btn-xs btn-danger' href='?a=ticket&id=".$row['id']."'' ><i class='glyphicon glyphicon-trash'></i></a>";
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
            $row['owner'] = '<a href=?a=edit-user&id='.GetUserIdWithEmail($row['owner'],$conn).'>'.$row['owner'].'</a>';
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
            $updateButton = "<a class='btn btn-xs btn-primary' href='?a=edit-address-kyc&id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
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
            $row['email'] = '<a href=?a=edit-user&id='.GetUserIdWithEmail($row['email'],$conn).'>'.$row['email'].'</a>';
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
            $updateButton = "<a class='btn btn-xs btn-primary' href='?a=edit-address-kyc&id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
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
            $row['email'] = '<a href=?a=edit-user&id='.GetUserIdWithEmail($row['email'],$conn).'>'.$row['email'].'</a>';
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
            $updateButton = "<a class='btn btn-xs btn-primary' href='?a=edit-address-kyc&id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
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
            $row['email'] = '<a href=?a=edit-user&id='.GetUserIdWithEmail($row['email'],$conn).'>'.$row['email'].'</a>';
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
            $updateButton = "<a class='btn btn-xs btn-primary' href='?a=edit-address-kyc&id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
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
            $row['email'] = '<a href=?a=edit-user&id='.GetUserIdWithEmail($row['email'],$conn).'>'.$row['email'].'</a>';
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
            $updateButton = "<a class='btn btn-xs btn-primary' href='?a=edit-identity-kyc&id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
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
            $row['email'] = '<a href=?a=edit-user&id='.GetUserIdWithEmail($row['email'],$conn).'>'.$row['email'].'</a>';
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
            $updateButton = "<a class='btn btn-xs btn-primary' href='?a=edit-identity-kyc&id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
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
            $row['email'] = '<a href=?a=edit-user&id='.GetUserIdWithEmail($row['email'],$conn).'>'.$row['email'].'</a>';
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
            $updateButton = "<a class='btn btn-xs btn-primary' href='?a=edit-identity-kyc&id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
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
            $row['email'] = '<a href=?a=edit-user&id='.GetUserIdWithEmail($row['email'],$conn).'>'.$row['email'].'</a>';
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
            $updateButton = "<a class='btn btn-xs btn-primary' href='?a=edit-identity-kyc&id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
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
            $row['email'] = '<a href=?a=edit-user&id='.GetUserIdWithEmail($row['email'],$conn).'>'.$row['email'].'</a>';
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
        $sql = "select * from admin where email!='$email'";
        $r = $conn->query($sql);
        $rows = array();
        $data = [];
        while($row = mysqli_fetch_array($r)){
            $updateButton = "<a class='btn btn-xs btn-primary' href='?a=edit-admin&id=".$row['id']."'' ><i class='glyphicon glyphicon-edit'></i></a>";
            $deleteButton = "<a class='btn btn-xs btn-danger' onclick='javascript:confirmationDelete($(this));return false;' href='?a=admin&id=".$row['id']."'' ><i class='glyphicon glyphicon-trash'></i></a>";
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