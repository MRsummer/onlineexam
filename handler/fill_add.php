<?php

require_once("../lib/require.php");
require_once("../helper/user.php");

//check privilege
User::CheckTeacher();

$content = $_POST["content"];
$cA = trim($_POST["answerA"]);
$cB = trim($_POST["answerB"]);
$cC = trim($_POST["answerC"]);
$cD = trim($_POST["answerD"]);
$answer = json_encode(array("A"=>$cA,"B"=>$cB,"C"=>$cC,"D"=>$cD));

Mysql::getDB()->exec("insert into fill (content, answer, chapter, difficulty, tag) "
    ."values ('$content', '$answer', '', 0, '' )");

Uri::redirect("/view/fill.html.php");
