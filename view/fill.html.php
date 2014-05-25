<?php
require_once("../lib/require.php");
$sql = "select * from fill order by id desc";
$res = Mysql::getDB()->query($sql);
?>

<html>
<?php include("head.html"); ?>
<body>
<div style="width: 70%;margin: 0 auto;">

<?php $location="fill"; include("header.html.php"); ?>

<!--添加题目区域-->
<div class="panel panel-default">
    <div class="panel-heading">添加一道填空题</div>
    <div class="panel-body">
        <form role="form"  method="post" action="/handler/fill_add.php">
            <div class="form-group">
                <label for="begintime">题目名称：</label>
                <textarea name="content" id="content" style="width: 800px;height:100px;" ></textarea>
            </div>
            <div class="form-group">
                <label for="answerA">答案1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;：</label>
                <input type="text" name="answerA" id="answerA" style="width: 800px;">
            </div>
            <div class="form-group">
                <label for="answerB">答案2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;：</label>
                <input type="text" name="answerB" id="answerB" style="width: 800px;">
            </div>
            <div class="form-group">
                <label for="answerC">答案3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;：</label>
                <input type="text" name="answerC" id="answerC" style="width: 800px;">
            </div>
            <div class="form-group">
                <label for="answerD">答案3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;：</label>
                <input type="text" name="answerD" id="answerD" style="width: 800px;">
            </div>
            <button type="submit" class="btn btn-default">添加</button>
        </form>
    </div>
</div>


<div class="panel panel-default">
    <div class="panel-heading">填空题</div>
    <div class="panel-body">
        <?php foreach($res as $item){  $choices = json_decode($item["answer"]); ?>
        <a class="list-group-item">
            <h4 class="list-group-item-heading">题目：<?=$item["content"]?></h4>
            <p class="list-group-item-text">题目编号：<?=$item["id"]?></p>
            <p class="list-group-item-text">答案：
                <?php foreach($choices as $key=>$c){ echo "<p>".$key."，".$c."</p>"; }?>
            </p>
            <p class="list-group-item-text">
                <span style="color: red;cursor: pointer;" onclick="javascript:location.href='/handler/delete.php?type=fill&id=<?=$item["id"]?>'">删除此题</span>
            </p>
        </a>
        <?php } ?>
    </div>
</div>

</div>
</body>
</html>