<html>
<head>
    <title>C语言上级考试系统</title>
</head>
<body>

<h1>发起一场考试 <a href="/view/index.html.php">返回</a></h1>

<!--添加考试-->
<form method="post" action="/handler/exam_add.php">
    <p>
        考试类型：
        <select name="examtype">
            <option value="0">统一试卷</option>
            <option value="1">随机试卷</option>
        </select>
    </p>
    <p>
        开始时间：<input type="text" name="begintime"> （格式：2013-11-23 11:00）
    </p>
    <p>
        结束时间：<input type="text" name="endtime"> （格式：2013-11-23 11:00）
    </p>
    <p>
        考卷：(统一考卷需要选择)
        <select name="paper">
        <?php
            require_once("../lib/require.php");
            $res = Mysql::getDB()->query("select * from paper order by id desc");
            foreach($res as $item){
                echo "<option value='".$item["id"]."'>".$item["name"]."</option>";
            }
        ?>
        </select>
    </p>
    <input type="submit" value="添加">
</form>

<!--考试列表-->
<?php
    $res = Mysql::getDB()->query("select * from exam order by id desc");
    foreach($res as $item){
        $paper = Mysql::getDB()->query("select * from paper where id = ".$item["paper"])[0];
        echo "<p>";
            echo "考试名称：".$paper["name"]."<br>";
            echo "考试考试时间：".$item["begintime"]."<br>";
            echo "考试结束时间：".$item["endtime"]."<br>";
            echo "试卷名称：".isset($paper["name"]) ? $paper["name"] : "没有名称的试卷"."<br>";
            echo "<a href='/view/paper.html.php?paper=".$item['paper']."'>查看试卷</a><br>";
            echo "参加考试的学生和答题情况：<a href='/view/examlist.html.php?exam=".$item["id"]."'>查看</a><br>";
            echo "<a href='/handler/test_score.php?exam=".$item["id"]."'>开始自动评卷</a><br>";
            echo "<a href='/handler/test_cheat.php?exam=".$item["id"]."'>开始自动查找作弊</a><br>";
        echo "</p>";
    }
?>

</body>
</html>