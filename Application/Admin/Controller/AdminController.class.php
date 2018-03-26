<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Verify;

class AdminController extends Controller {
	/*登录*/
	function login(){
		if(IS_POST){
			$params = I('post.');
			if(empty($params['username'])){
				$this->error('用户名不能为空');
			}
			if(empty($params['userpwd'])){
				$this->error('密码不能为空');
			}
			if(empty($params['usercode'])){
				$this->error('请输入验证码');
			}
			$verify = new Verify();
	        if(!$verify->check($params['usercode'])){
	            $this->error("验证码错误");
	        }
			$list = M('backuser')->where(array('username'=>$params['username']))->find();
			if(empty($list)){
				$this->error('用户名不存在');
			}
			//$nowpwd = generateHash($params['userpwd'],$list['salt']);
			$nowpwd = '123456';
			if($nowpwd != $list['password']){
				$this->error('用户名/密码错误');
			}
			$role = M('role')->field('rolename')->where(array('id'=>$list['role']))->find();
			$doedit = array(
					'lasttime'=>time(),
					'lastip'=>$_SERVER['REMOTE_ADDR'],
					'logcount'=>$list['logcount']+1
				);
			$res = M('backuser')->where(array('id'=>$list['id']))->save($doedit);
			session('back.userid',$list['id']);
			session('back.username',$list['username']);
			session('back.userrole',$list['role']);
			session('back.userrolename',$role['rolename']);
			$this->success('登录成功',U('index/index'));
			die;
		}
		$this->display();		
	}
	/*验证码*/
	function showcode(){
        $config = array(
            'length'=>4,
            'useNoise'=>false,
            'useCurve'=>false
        );
        $verify = new \Think\Verify($config);
        $verify->entry();
    }
    /*登出*/
    function logout(){
    	session('back',null);
        $this->redirect('admin/login');
    }








}