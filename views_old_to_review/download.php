<?php
include_once '../dal/dal_prm.php';

function DownloadFile($File_name, $Original_file_name)
{
	$path = '../prm_uploads/'.$File_name;

	if (file_exists($path) && strpos($File_name, '/') === FALSE && strpos($File_name, '.') !== 0)
	{
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'.$Original_file_name.'"');
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' .filesize($path));
		readfile($path);
		exit;
	}
	else
		require('download_unexisting_file.php');
}

if(!empty($_GET['file_id']))
{
	$file_name = file_GetFileName($_GET['file_id']);
	if ($file_name == '')
		require('download_unexisting_file.php');
	else
		DownloadFile($file_name, file_GetOrginalFileName($_GET['file_id']));
}
else
	require('download_unexisting_file.php');
