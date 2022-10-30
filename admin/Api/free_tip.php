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
    $sel = $connection->query("select * from free_tip ");
    $g=array();
    $po= array();
    while($row = $sel->fetch_assoc())
    {
        /*
         *        `f_tip_id` int(11) NOT NULL,
                  `admin_id` int(11) NOT NULL,
                  `m_date` varchar(50) NOT NULL,
                  `country` varchar(100) NOT NULL,
                  `teams` varchar(100) NOT NULL,
                  `odd` varchar(50) NOT NULL,
                  `cs_tip` varchar(100) NOT NULL,
                  `tip` varchar(100) NOT NULL,
                  `result` varchar(100) NOT NULL,
                  `status` int(11) NOT NULL,
                  `push` int(11) NOT NULL
         */
        $g['f_tip_id'] = $row['f_tip_id'];
        $g['admin_id'] = $row['admin_id'];
        $g['m_date'] = $row['m_date'];
        $g['country'] = $row['country'];
        $g['teams'] = $row['teams'];
        $g['odd'] = $row['odd'];
        $g['cs_tip'] = $row['cs_tip'];
        $g['tip'] = $row['tip'];
        $g['result'] = $row['result'];
        $g['status'] = $row['status'];
        $g['push'] = $row['push'];

        $po[] = $g;

    }
    $returnArr = array("Data"=>$po,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"free tips  retrieved Successfully!!!");
}
echo json_encode($returnArr, JSON_PRETTY_PRINT);