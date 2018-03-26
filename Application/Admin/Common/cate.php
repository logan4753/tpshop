<?php

	function cate(){
		$pid = $_POST['pid'];
		$model = M('category');
		$result = $model->where(array('pid'=>$pid))->select();
		echo json_encode($result));
	}