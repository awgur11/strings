<?php
$db_type='mysql';

$C=array();

$C['DB_HOST']='localhost';

$C['DB_LOGIN']='';

$C['DB_PASSWORD']='';

$C['DB_NAME']='';

foreach($C as $kc => $vc)
{
  define($kc, $vc, true);   
}

//if ($db_type == 'mysql') $connect = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8";   
//elseif($db_type == 'sqlite') $connect = 'sqlite:DB/sqlite/'.DB_NAME;
        
    
