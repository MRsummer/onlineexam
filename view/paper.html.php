<?php
//此处做权限验证，还没有开始的考试试卷只能由老师查看，考过的试卷可以由学生查看
require_once("../lib/require.php");
require_once("../helper/user.php");
require_once("../helper/paper.php");

if(! (isset($_GET["paper"]) && is_numeric($_GET["paper"])) ) Uri::goBack("该页面不存在");
$paper = Mysql::getDB()->query("select * from paper where id = ".addslashes($_GET["paper"]));
count($paper) == 0 ? Uri::goBack("该页面不存在") : $paper = $paper[0];
$paper = Paper::getPaper($paper);
?>

<html>
<head>
    <title>C语言上级考试系统</title>
</head>
<body>
<p><h1><?=$paper["name"]?> <a href="<?=$_SERVER["HTTP_REFERER"]?>">返回</a></h1></p>
<p>
    <h2>选择题</h2>
    <?php
    foreach($paper["choose"] as $item){
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
        echo "</p>";
    }
    ?>
</p>
<p>
<h2>填空题</h2>
<?php
foreach($paper["fill"] as $item){
    echo "<p>";
    echo "题目编号：".$item["id"]."<br>";
    echo "题目：".$item["content"]."<br>";
    echo "答案：";
    $choices = json_decode($item["answer"]);
    foreach($choices as $key=>$c){
        echo "<p>".$key."，".$c."</p>";
    }
    echo "</p>";
}
?>
</p>
<p>
<h2>编程题</h2>
<?php
foreach($paper["program"] as $item){
    echo "<p>";
    echo "题目编号：".$item["id"]."<br>";
    echo "题目：<textarea>".$item["content"]."</textarea><br>";
    echo "答案：<textarea>".$item["answer"]."</textarea><br>";
    echo "</p>";
}
?>
</p>

</body>
</html>