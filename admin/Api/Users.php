<?php
require 'db.php';
$data = json_decode(file_get_contents('php://input'), true);
if($data['uid'] == 'h')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    $uid =  strip_tags(mysqli_real_escape_string($connection,$data['uid']));
    $sel = $connection->query("select * from user ");
    $g=array();
    $po= array();
    while($row = $sel->fetch_assoc())
    {
        $g['id'] = $row['id'];
        $g['rank'] = $row['rank'];
        $g['firstname'] = $row['firstname'];
        $g['lastname'] = $row['lastname'];
        $g['username'] = $row['username'];
        $g['password'] = $row['password'];
        $g['package'] = $row['package'];
        $g['phone'] = $row['phone'];
        $g['email'] = $row['email'];
        $g['reg_time'] = $row['reg_time'];

        $po[] = $g;

    }
    $returnArr = array("Data"=>$po,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Users data retrieved Successfully!!!");
}
echo json_encode($returnArr, JSON_PRETTY_PRINT);