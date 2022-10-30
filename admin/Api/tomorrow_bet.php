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
    $sel = $connection->query("select * from tomorrow_bet ");
    $g=array();
    $po= array();
    while($row = $sel->fetch_assoc())
    {
        /*
         *    `tb_id` int(11) NOT NULL,
              `admin_id` int(11) NOT NULL,
              `tb_date` varchar(100) NOT NULL,
              `country` varchar(100) NOT NULL,
              `team` varchar(100) NOT NULL,
              `tip` varchar(100) NOT NULL,
              `result` varchar(100) NOT NULL,
              `status` int(11) NOT NULL,
              `date_bet` int(11) NOT NULL,
              `when_bet` int(11) NOT NULL,
              `month_bet` int(11) NOT NULL
         */
        $g['tb_id'] = $row['tb_id'];
        $g['admin_id'] = $row['admin_id'];
        $g['tb_date'] = $row['tb_date'];
        $g['country'] = $row['country'];
        $g['team'] = $row['team'];
        $g['tip'] = $row['tip'];
        $g['result'] = $row['result'];
        $g['status'] = $row['status'];
        $g['date_bet'] = $row['date_bet'];
        $g['when_bet'] = $row['when_bet'];
        $g['month_bet'] = $row['month_bet'];

        $po[] = $g;

    }
    $returnArr = array("Data"=>$po,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"tomorrow bets  retrieved Successfully!!!");
}
echo json_encode($returnArr, JSON_PRETTY_PRINT);