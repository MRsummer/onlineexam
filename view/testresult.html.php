<?php
require_once("../lib/require.php");
require_once("../helper/user.php");
require_once("../helper/paper.php");

User::checkLogin();

//教师可以查看所有结果，个人只能查看自己的结果
if(! (isset($_GET["result"]) && is_numeric($_GET["result"])) ) Uri::goBack("访问出错");
$result = Mysql::getDB()->query("select * from result where id = ".$_GET["result"]);
count($result) == 0 ? Uri::goBack("访问出错") : ($result = $result[0]);
if(! User::isTeacher() && $_SESSION["uid"] != $result["user"]) Uri::goBack("访问出错");

$paper = Paper::getExamPaper($result["exam"]);

//取出学生作答
$resultAnswer = json_decode($result["answer"], true);
$resultChoose = $resultAnswer["choose"];
$resultFill = $resultAnswer["fill"];
$resultProgram = $resultAnswer["program"];
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
foreach($paper["choose"] as $index=>$item){
    echo "<p>";
    echo "题目编号：".$item["id"]."<br>";
    echo "题目：".$item["content"]."<br>";
    echo "选项：";
    $choices = json_decode($item["choice"]);
    foreach($choices as $key=>$value){
        echo $key.",".$value."   ";
    }
    echo "<br>";
    echo "参考答案：".$item["answer"]."<br>";
    echo "我的答案：".$resultChoose[$index.""]."<br>";
    echo "我的得分：".$resultChoose[$index."s"]."<br>";
    echo "</p>";
}
?>
</p>
<p>
<h2>填空题</h2>
<?php
foreach($paper["fill"] as $index=>$item){
    echo "<p>";
    echo "题目编号：".$item["id"]."<br>";
    echo "题目：".$item["content"]."<br>";
    echo "参考答案：";
    $choices = json_decode($item["answer"]);
    foreach($choices as $key=>$c){
        echo "".$key."，".$c."   ";
    }
    echo "<br>";
    echo "我的答案：".$resultFill[$index.""]."<br>";
    echo "我的得分：".$resultFill[$index."s"]."<br>";
    echo "</p>";
}
?>
</p>
<p>
<h2>编程题</h2>
<?php
foreach($paper["program"] as $index=>$item){
    echo "<p>";
    echo "题目编号：".$item["id"]."<br>";
    echo "题目：<textarea>".$item["content"]."</textarea><br>";
    echo "参考答案：<textarea>".$item["answer"]."</textarea><br>";
    echo "我的答案：".$resultProgram[$index.""]."<br>";
    echo "我的得分：".$resultProgram[$index."s"]."<br>";
    echo "</p>";
}
?>
</p>

</body>
</html>



