<?php

require_once("../lib/require.php");
require_once("../helper/user.php");

//check privilege
User::CheckTeacher();

$content = $_POST["content"];
$answer = $_POST["answer"];
$iA = $_POST["testinA"];
$oA = $_POST["testoutA"];
$iB = $_POST["testinB"];
$oB = $_POST["testoutB"];
$iC = $_POST["testinC"];
$oC = $_POST["testoutC"];
$iD = $_POST["testinD"];
$oD = $_POST["testoutD"];

$testdata = json_encode(array(
    "iA"=>$iA, "oA"=>$oA,
    "iB"=>$iB, "oB"=>$oB,
    "iC"=>$iC, "oC"=>$oC,
    "iD"=>$iD, "oD"=>$oD
));

Mysql::getDB()->exec("insert into program (content, answer, testdata, chapter, difficulty, tag) "
    ."values ('$content', '$answer', '$testdata', '', 0, '' )");

Uri::redirect("/view/program.html.php");
