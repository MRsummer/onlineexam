<html>
<head>
    <title>C语言上级考试系统</title>
</head>
<body>

<h1>添加试卷  <a href="/view/index.html.php">返回</a></h1>

<!--区域-->
<form method="post" action="/handler/paper_add.php">
    <p>
        考题名称：
        <input type="text" name="papername">
    </p>
    <p>
        20个选择题：
        编号输入： <input type="text" name="choose">  (格式：从选择题中查找到合适的题目编号并输入，如 3 5 12 9 2 ,,, 97 共20个数字，用空格分隔开)
    </p>
    <p>
        10个填空题：
        编号输入：<input type="text" name="fill"> (格式：从填空题中查找到合适的题目编号并输入，如 3 5 12 9 2 ,,, 97 共10个数字，用空格分隔开)
    </p>
    <p>
        5个编程题：
        编号输入：<input type="text" name="program"> (格式：从编程题中查找到合适的题目编号并输入，如 3 9 2 ,,, 97 共5个数字，用空格分隔开)
    </p>
    <input type="submit" value="添加">
</form>

<!--试卷列表-->
<?php
require_once("../lib/require.php");
$papers = Mysql::getDB()->query("select user.name as username, paper.name as papername, difficulty, paper, paper.id as paperid from paper join user on paper.user = user.id order by paper.id desc");
foreach($papers as $item){
    echo "<p>";
    echo "命题人：".$item["username"]."<br>";
    echo "试卷名称：".$item["papername"];
    echo "难度系数：".$item["difficulty"]."<br>";
    echo "<a href='/view/paper.html.php?paper=".$item["paperid"]."'>查看试卷</a>";
    echo "<a href='/handler/delete.php?type=paper&id=".$item["paperid"]."'>删除此试卷</a>";
    echo "</p>";
}
?>

</body>
</html>