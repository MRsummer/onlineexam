<?php
require_once("../lib/require.php");
require_once("../helper/user.php");
User::checkTeacher();
if(! is_numeric($_GET["exam"])) Uri::goBack("访问出错");
$results = Mysql::getDB()->query("select result.id, user.name, user.num, result.score from result join user on user.id = result.user where exam = ".$_GET["exam"]);
?>
<html>
<head>
    <title>C语言上级考试系统</title>
    <?php include("header.html"); ?>
</head>
<body>

<h1>参加过本场考试的学生  <a href="/view/exam.html.php">返回</a></h1>
<p>
    <?php foreach($results as $item){ ?>
    <p>
        姓名：<?=$item["name"]?><br>
        学号：<?=$item["num"]?><br>
        分数：<?=$item["score"]?><br>
        答题细节：<a href="/view/testresult.html.php?result=<?=$item["id"]?>">查看</a><br>
    </p>
    <?php } ?>
</p>

</body>
</html>