<?php
require_once("../lib/require.php");
$res = Mysql::getDB()->query("select * from choose order by id desc");
?>


<html>
<head>
    <?php include("head.html"); ?>
</head>
<body>
<div style="width: 70%;margin: 0 auto;">
<?php $location="choose"; include("header.html.php"); ?>

<div class="panel panel-default">
    <div class="panel-heading">添加一道选择题</div>
    <div class="panel-body">
        <form role="form"  method="post" action="/handler/choose_add.php">
            <div class="form-group">
                <label for="content">题目名称&nbsp;&nbsp;：</label>
                <textarea name="content" id="content" style="width: 800px;height:100px;" ></textarea>
            </div>
            <div class="form-group">
                <label for="choiceA">题目选项A：</label>
                <input type="text" name="choiceA" id="choiceA" style="width:800px;">
            </div>
            <div class="form-group">
                <label for="choiceB">题目选项B：</label>
                <input type="text" name="choiceB" id="choiceB" style="width:800px;">
            </div>
            <div class="form-group">
                <label for="choiceC">题目选项C：</label>
                <input type="text" name="choiceC" id="choiceC" style="width:800px;">
            </div>
            <div class="form-group">
                <label for="choiceD">题目选项D：</label>
                <input type="text" name="choiceD" id="choiceD" style="width:800px;">
            </div>
            <div class="form-group">
                <label for="answer">正确答案&nbsp;&nbsp;：</label>
                <select name="answer" id="answer">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
            </div>
            <button type="submit" class="btn btn-default">添加</button>
        </form>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">选择题</div>
    <div class="panel-body">
        <?php foreach($res as $item){  $choices = json_decode($item["choice"]); ?>
        <a class="list-group-item">
            <h4 class="list-group-item-heading">题目：<?=$item["content"]?></h4>
            <p class="list-group-item-text">题目编号：<?=$item["id"]?></p>
            <p class="list-group-item-text">选项：
                <?php foreach($choices as $key=>$value) echo $key.",".$value."   "; ?>
            </p>
            <p class="list-group-item-text">正确答案：<?=$item["answer"]?></p>
            <p class="list-group-item-text">
                <span style="color: red;cursor: pointer;" onclick="javascript:location.href='/handler/delete.php?type=choose&id=<?=$item["id"]?>'">删除此题</span>
            </p>
        </a>
        <?php } ?>
    </div>
</div>

</div>
</body>
</html>