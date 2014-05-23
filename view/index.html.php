<?php
require_once("../lib/require.php");
require_once("../helper/user.php");
User::checkLogin();
?>

<?php if(! User::isTeacher()){ ?>
<!--学生页面-->
<html>
<head>
    <title>C语言上级考试系统</title>
    <?php include("header.html"); ?>
</head>
<body>
<p>
    <h1>我的信息 <a href="/handler/logout.php">退出登录</a></h1>
    姓名：<?=$_SESSION["name"]?>
    学号：<?=$_SESSION["num"]?>
</p>
<p>
    <h1>我参加过的考试</h1>
    <?php $results = Mysql::getDB()->query("select id, user, score, exam from result where user =".$_SESSION["uid"]." order by id desc"); ?>
    <?php foreach($results as $result){
    $exam = Mysql::getDB()->query("select * from exam where id = ".$result["exam"])[0];
    $paper = Mysql::getDB()->query("select * from paper where id = ".$exam["paper"])[0]; ?>
    <p>
        类型：<?php echo $exam["type"] == 0 ? "统一试卷" : "随机试卷"; ?><br>
        开始时间：<?php echo $exam["begintime"]; ?><br>
        结束时间：<?php echo $exam["endtime"]; ?><br>
        我的答题情况：<a href="/view/testresult.html.php?result=<?=$result['id']?>"><?php echo $paper["name"]; ?></a><br>
    </p>
    <?php } ?>

</p>
<p>
    <h1>当前考试</h1>
    <?php
        $date = date("Y-m-d H:i:s");
        $currentExams = Mysql::getDB()->query("select * from exam where begintime < '".$date."' and endtime > '".$date."' ");
        foreach($currentExams as $exam){
            echo "考试时间：".$exam["begintime"]." - ".$exam["endtime"]."<br>";
            echo "<a href='/view/test.html.php?exam=".$exam["id"]."'>进入考试</a><br>";
        }
    ?>
</p>
</body>
</html>

<?php }else{ ?>
<!--教师页面-->
<html>
    <head>
        <title>C语言上级考试系统</title>
        <?php include("header.html"); ?>
    </head>
    <body>
    <p>
        <h1>我的信息（老师页面）<a href="/handler/logout.php">退出登录</a></h1>
        姓名：<?=$_SESSION["name"]?>
        学号：<?=$_SESSION["num"]?>
    </p>
    <p>
        <h3><a href="/view/user.html.php">学生列表</a></h3>
        <h3><a href="/view/exam.html.php">考试管理</a></h3>
        <h3><a href="/view/choose.html.php">选择题题库</a></h3>
        <h3><a href="/view/fill.html.php">填空题题库</a></h3>
        <h3><a href="/view/program.html.php">编程题题库</a></h3>
        <h3><a href="/view/papers.html.php">试卷管理</a></h3>
    </p>
    </body>
</html>
<?php } ?>
