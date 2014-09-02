<?php 
	require_once _libs."realajaxuploader"._dsep."upfile.php";
	require_once _help."helps.php";
	if($response['status'] == 1){
		$dir = _img_tmp;
		$img = $response['name'];
		$size = getDimensionsImg($dir.$img);
		if(is_null($size['height'])){			
			removeFile($dir.$img);
			//$response = array('name'=>$img, 'size'=>0, 'status'=>'error', 'info'=>"Not Valid Image");
		}else{						
			$unique = renameFile($img,$dir);
			$_SESSION[sname]['file'] = $unique;
		}
	}
	echo json_encode($response);
?>