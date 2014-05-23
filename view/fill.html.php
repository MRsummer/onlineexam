<html>
<head>
    <title>C语言上级考试系统</title>
</head>
<body>

<h1>填空题  <a href="/view/index.html.php">返回</a></h1>

<!--添加题目区域-->
<form method="post" action="/handler/fill_add.php">
    <p>题目名称：<input type="text" name="content"></p>
    <p>答案1：<input type="text" name="answerA"></p>
    <p>答案2：<input type="text" name="answerB"></p>
    <p>答案3：<input type="text" name="answerC"></p>
    <p>答案4：<input type="text" name="answerD"></p>
    <input type="submit" value="添加">
</form>

<!--题目列表-->
<?php
    require_once("../lib/require.php");
    $sql = "select * from fill order by id desc";
    $res = Mysql::getDB()->query($sql);
    foreach($res as $item){
        echo "<p>";
            echo "题目编号：".$item["id"]."<br>";
            echo "题目：".$item["content"]."<br>";
            echo "答案：";
            $choices = json_decode($item["answer"]);
            foreach($choices as $key=>$c){
                echo "<p>".$key."，".$c."</p>";
            }
            echo "<a href='/handler/delete.php?type=fill&id=".$item["id"]."'>删除此题</a>";
        echo "</p>";
    }
?>

</body>
</html>