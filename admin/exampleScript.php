<?php
$fileToZip="License.txt";
//$fileToZip1="CreateZipFileMac.inc.php";
$fileToZip2="CreateZipFile.inc.php";

$directoryToZip="backup/"; // This will zip all the file(s) in this present working directory

$outputDir="/"; //Replace "/" with the name of the desired output directory.
$zipName="backup.zip";

include_once("CreateZipFile.inc.php");
$createZipFile=new CreateZipFile;


echo "<script>alert('Your Database stored in backup folder')</script>";
echo "<script>window.location='db-backup.php'</script>";
?>