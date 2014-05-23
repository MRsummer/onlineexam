<html>
<head>
    <title>C语言上级考试系统</title>
</head>
<body>

<h1>编程题  <a href="/view/index.html.php">返回</a></h1>

<!--添加题目区域-->
<form method="post" action="/handler/program_add.php">
    <p>
        <p>题目名称：<textarea name="content"></textarea></p>
        <p>示例答案：<textarea name="answer"></textarea></p>
        <p>测试数据输入：<input type="text" name="testinA">  期望输出：<input type="text" name="testoutA"></p>
        <p>测试数据输入：<input type="text" name="testinB">  期望输出：<input type="text" name="testoutB"></p>
        <p>测试数据输入：<input type="text" name="testinC">  期望输出：<input type="text" name="testoutC"></p>
        <p>测试数据输入：<input type="text" name="testinD">  期望输出：<input type="text" name="testoutD"></p>
        <input type="submit" value="添加">
    </p>
</form>

<!--题目列表-->
<?php
    require_once("../lib/require.php");
    $sql = "select * from program order by id desc";
    $res = Mysql::getDB()->query($sql);
    foreach($res as $item){
        echo "<p>";
            echo "题目编号：".$item["id"]."<br>";
            echo "题目：<textarea>".$item["content"]."</textarea><br>";
            echo "答案：<textarea>".$item["answer"]."</textarea><br>";
            echo "<a href='/handler/delete.php?type=program&id=".$item["id"]."'>删除此题</a>";
        echo "</p>";
    }
?>

</body>
</html>