<?php
// 检测是否已经安装
//if(!file_exists('./Apps/Install/Conf/install.lock')){
//    //$install = U('Install/index');
//    var_dump(U('Install/index'));
//    die;
//    header('Location:'.U("Install/index"));
//}
define('APP_PATH','./Apps/');
define('APP_NAME','Home');
define('APP_DEBUG',true);
define('RUNTIME_PATH','./Runtime/');

require './ThinkPHP/ThinkPHP.php';

?>
