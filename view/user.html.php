<?php
    require_once("../lib/require.php");
    require_once("../conf/appconf.php");
    require_once("../helper/user.php");
    User::checkTeacher();
    $users = Mysql::getDB()->query("select * from user order by id desc");
?>

<html>
<head>
    <title>C语言上级考试系统</title>
</head>
<body>
    <h1>用户列表  <a href="/view/index.html.php">返回</a></h1>
    <?php foreach($users as $user){ ?>
    <p>
        姓名：<?php echo $user["name"]; ?><br>
        学号：<?php echo $user["num"]; ?><br>
        身份：<?php echo in_array($user["num"],AppConf::getConf()["ROLE_MANAGER_MUM"]) ? "管理员"
            : (in_array($user["num"],AppConf::getConf()["ROLE_TEACHER_MUM"]) ? "老师" : "学生") ?>
    </p>
    <?php } ?>
</body>
</html>