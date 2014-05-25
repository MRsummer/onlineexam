<?php
require_once("../lib/require.php");
$sql = "select * from program order by id desc";
$res = Mysql::getDB()->query($sql);
?>


<html>
<?php include("head.html"); ?>
<body>
<div style="width: 70%;margin: 0 auto;">
<?php $location="program"; include("header.html.php"); ?>

<!--添加题目区域-->
<div class="panel panel-default">
    <div class="panel-heading">添加编程题</div>
    <div class="panel-body">
        <form role="form"  method="post" action="/handler/program_add.php">
            <div class="form-group">
                <label for="content">题目名称：</label>
                <textarea name="content" id="content" style="width: 800px;max-width: 800px;height: 100px;"></textarea>
            </div>
            <div class="form-group">
                <label for="answer">示例答案：</label>
                <textarea name="answer" id="answer" style="width: 800px;max-width: 800px;height: 100px;"></textarea>
            </div>
            <div class="form-group">
                <label for="testinA">测试组一：</label>
                输入：<input type="text" name="testinA" id="testinA" style="width: 300px;">
                输出：<input type="text" name="testoutA" style="width: 300px;">
            </div>
            <div class="form-group">
                <label for="testinB">测试组一：</label>
                输入：<input type="text" name="testinB" id="testinB" style="width: 300px;">
                输出：<input type="text" name="testoutB" style="width: 300px;">
            </div>
            <div class="form-group">
                <label for="testinC">测试组一：</label>
                输入：<input type="text" name="testinC" id="testinC" style="width: 300px;">
                输出：<input type="text" name="testoutC" style="width: 300px;">
            </div>
            <div class="form-group">
                <label for="testinD">测试组一：</label>
                输入：<input type="text" name="testinD" id="testinD" style="width: 300px;">
                输出：<input type="text" name="testoutD" style="width: 300px;">
            </div>
            <button type="submit" class="btn btn-default">添加</button>
        </form>
    </div>
</div>


<div class="panel panel-default">
    <div class="panel-heading">编程题</div>
    <div class="panel-body">
        <?php foreach($res as $item){ ?>
        <a class="list-group-item">
            <h4 class="list-group-item-heading">题目：<?=$item["content"]?></h4>
            <p class="list-group-item-text">题目编号：<?=$item["id"]?></p>
            <p class="list-group-item-text">答案：
                <textarea readonly="readonly" style="width: 800px;max-width:800px;height: 100px;">
                    <?php echo trim($item["answer"])?>
                </textarea>
            </p>
            <p class="list-group-item-text">
                <span style="color: red;cursor: pointer;" onclick="javascript:location.href='/handler/delete.php?type=program&id=<?=$item["id"]?>'">删除此题</span>
            </p>
        </a>
        <?php } ?>
    </div>
</div>

</div>
</body>
</html>