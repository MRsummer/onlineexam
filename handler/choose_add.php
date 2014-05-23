<?php
require_once("../lib/require.php");
require_once("../helper/user.php");

//check privilege
User::CheckTeacher();

$content = $_POST["content"];
$cA = $_POST["choiceA"];
$cB = $_POST["choiceB"];
$cC = $_POST["choiceC"];
$cD = $_POST["choiceD"];
$answer = $_POST["answer"];
$choice = json_encode(array("A"=>$cA,"B"=>$cB,"C"=>$cC,"D"=>$cD));

Mysql::getDB()->exec("insert into choose (content, choice, answer, chapter, difficulty) "
    ."values ('$content', '$choice', '$answer', '', 0 )");

Uri::redirect("/view/choose.html.php");
