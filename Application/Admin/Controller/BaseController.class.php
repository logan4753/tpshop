<?php 
namespace Admin\Controller;
use Think\Controller;

class BaseController extends Controller{

	function _initialize(){
		if(!session('back.userid')){
			$this->error('请登录',U('login/login'));
		}
		$roleid = session('back.userrole');
		$power = M('role')->field('power')->where(array('id'=>$roleid))->find();
		$permission = explode(',',$power['power']);
		if($roleid != 1){
			$where = array('status'=>1,'id'=>array('in',$permission));
		}else{
			$where = array();
		}		
		$datas = M('permission')->where($where)->select();
		$show = array();
		foreach($datas as $k => $v){
			array_push($show,$v['peract']);
		}
		$onact = strtolower(CONTROLLER_NAME . '/' .ACTION_NAME);
		$this->assign('onact',str_replace('/','_',$onact));
		//dump($onact);dump($show);die;
		if(!in_array($onact,$show) && $roleid != 1){
			$this->error('权限不足',U('index/index'));
		}
	}




}