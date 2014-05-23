<?php
//检查时间和权限
require_once("../lib/require.php");
require_once("../helper/user.php");
if(! is_numeric($_GET["exam"])) Uri::goBack("访问出错");
if(! User::isTeacher()){
    $exam = Mysql::getDB()->query("select * from exam where id = ".$_GET["exam"]);
    $date = date("Y-m-d H:i:s");
    if(count($exam) == 0) Uri::goBack("访问出错");
    if($date < $exam[0]["begintime"]) Uri::goBack("考试没还开始");

    //区分是统一考试还是随机考试
    if($exam[0]["type"] == "0"){
        //统一试卷
        $paper = Mysql::getDB()->query("select * from paper where id = ".$exam[0]["paper"])[0];
        $content = json_decode($paper["paper"], true);
        $choose = Mysql::getDB()->query("select * from choose where id in (".$content["choose"].")");
        $fill = Mysql::getDB()->query("select * from fill where id in (".$content["fill"].")");
        $program = Mysql::getDB()->query("select * from program where id in (".$content["program"].")");
        $testResult = Mysql::getDB()->query("select * from result where exam = ".$_GET["exam"]." and user = ".$_SESSION["uid"]);
        if(count($testResult) > 0){
            $result = json_decode($testResult[0]["answer"], true);
            $chooseResult = $result["choose"];
            $fillResult = $result["fill"];
            $programResult = $result["program"];
        }
    }else{
        //随机试卷
        die("暂不支持随机试卷!!!");
    }
}
?>

<html>
<head>
    <title>C语言上级考试系统</title>
</head>
<body>
<p><h1><?=$paper["name"]?> <a href="/view/index.html.php">返回</a></h1></p>
<h2>（注意：请在填写过程中注意点击提交以保存你填写的内容，考试时间结束前可以重复提交）</h2>
<p>
<form method="post" action="/handler/test_submit.php">
<p>
    <input type="submit" value="提交试卷" style="width:100px;">
</p>
<input type="hidden" name="exam" value="<?=$_GET['exam']?>" />
<h2>一，选择题</h2>
<?php
foreach($choose as $index=>$item){
    echo "<p>";
    echo "题目".($index+1)."：".$item["content"]."<br>";
    echo "选项：<br>";
    $choices = json_decode($item["choice"]);
    foreach($choices as $key=>$value){
        echo isset($chooseResult) && $key == $chooseResult["".$index]
            ? "<input type='radio' name='choose_".$index."' value='$key' checked='checked'>".$key.",".$value."<br>"
            : "<input type='radio' name='choose_".$index."' value='$key'>".$key.",".$value."<br>";
    }
    echo "</p>";
}
?>
</p>
<p>
<h2>二，填空题</h2>
<?php
foreach($fill as $index=>$item){
    echo "<p>";
    echo "题目".($index+1)."：".$item["content"]."<br>";
    echo isset($fillResult) ? "填写答案：<input type='text' name='fill_".$index."' value='".$fillResult["".$index]."'>"
        : "填写答案：<input type='text' name='fill_".$index."'>";
    echo "</p>";
}
?>
</p>
<p>
<h2>三，编程题（建议代码编写测试完成后再将代码复制粘贴到此框中）</h2>
<?php
foreach($program as $index=>$item){
    echo "<p>";
    echo "题目".($index+1)."：".$item["content"]."<br>";
    echo isset($programResult) ? "答案：<textarea name='program_".$index."'>".$programResult["".$index]."</textarea><br>"
        : "答案：<textarea name='program_".$index."'></textarea><br>";
    echo "</p>";
}
?>
</form>
</p>

</body>
</html>