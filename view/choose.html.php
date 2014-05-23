<html>
<head>
    <title>C语言上级考试系统</title>
    <?php include("header.html"); ?>
</head>
<body>

<h1>选择题  <a href="/view/index.html.php">返回</a></h1>

<!--添加题目区域-->
<form method="post" action="/handler/choose_add.php">
    <p>题目名称：<input type="text" name="content"></p>
    <p>题目选项A：<input type="text" name="choiceA"></p>
    <p>题目选项B：<input type="text" name="choiceB"></p>
    <p>题目选项C：<input type="text" name="choiceC"></p>
    <p>题目现象D：<input type="text" name="choiceD"></p>
    <p>正确答案： <select name="answer">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                 </select>
    </p>
    <input type="submit" value="添加">
</form>

<!--题目列表-->
<?php
require_once("../lib/require.php");
$res = Mysql::getDB()->query("select * from choose order by id desc");
foreach($res as $item){
    echo "<p>";
        echo "题目编号：".$item["id"]."<br>";
        echo "题目：".$item["content"]."<br>";
        echo "选项：";
        $choices = json_decode($item["choice"]);
        foreach($choices as $key=>$value){
            echo $key.",".$value."   ";
        }
        echo "<br>";
        echo "正确答案：".$item["answer"]."<br>";
        echo "<a href='/handler/delete.php?type=choose&id=".$item["id"]."'>删除此题</a>";
    echo "</p>";
}
?>

</body>
</html>