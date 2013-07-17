<?php
include '../configuration/configuration.php';
require_once $THIRD_PARTY_FOLDER.'mobile_device_detect/mobile_device_detect.php';
$mobile = mobile_device_detect();

if($mobile == true)
{
	header('location:../prm_mobile_views/index.php');
}
else
{
	header('location:../prm_pc_views/index.php');
}