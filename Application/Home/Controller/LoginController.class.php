<?php
namespace Home\Controller;
use Think\Controller;
use Think\Verify;

class LoginController extends Controller {
    /*登录*/
	function login(){
		if(IS_POST){
            $model = M('consumer');
            $post = I('post.');
            if(empty($post['username'])){
                $this->error('用户名不能为空');
            }
            if(empty($post['userpwd'])){
                $this->error('密码不能为空');
            }
            if(empty($post['usercode'])){
                $this->error('请输入验证码');
            }
            $verify = new Verify();
            if(!$verify->check($post['usercode'])){
                $this->error("验证码错误");
            }
            $list = $model->where(array('username'=>$post['username']))->find();
            if(empty($list)){
                $this->error('用户名/邮箱不存在');
            }
            $nowpwd = generateHash($post['userpwd'],$list['salt']);
            if($nowpwd != $list['password']){
                $this->error('用户名/密码错误');
            }
            $edit = array('visittime'=>time());
            $model->where(array('id'=>$list['id']))->save($edit);
            session('front.userid',$list['id']);
            session('front.username',$list['username']);
            $this->success('登录成功',U('index/index'),3);
            die;
		}
		$this->display();
	}
    /*验证码*/
	function showcode(){
        $config = array(
        	'fontSize'  =>  28,
            'length'=>4,
            'useNoise'=>false,
            'useCurve'=>false
        );
        $verify = new \Think\Verify($config);
        $verify->entry();
    }
    /*登出*/
    function logout(){
    	session('front',null);
    	$this -> success('登出成功',U('index/index'),3);
    }
    /*注册*/
    function register(){
        $model = M('consumer');
        if(IS_POST){
            $post = I('post.');
            //dump($post);die;
            if(empty($post['username'])){
                $this->error('邮箱不能为空');die;
            }
            if(empty($post['password'])){
                $this->error('密码不能为空');die;
            }
            if(empty($post['showcode'])){
                $this->error('请输入验证码');die;
            }
            $verify = new Verify();
            if(!$verify->check($post['showcode'])){
                $this->error("验证码错误");die;
            }
            unset($post['showcode']);
            $post['salt'] = getsalt();
            $post['logintime'] = time();
            $post['password'] = generateHash($post['password'],$post['salt']);
            $data = $model->create($post);
            if(!$data) {
                $this -> error($model -> getError()); die;
            }
            $result = $model -> add();
            if ($result) {
                $this->ajaxReturn(array('status'=>1));
            } else {
                $this->error('添加失败');
            }
        }else{
            $this->display();
        }    	
    }
    /*找回密码*/
    public function findpwd(){
        if(IS_POST){
            $consumermodel = M('consumer');
            $post = I('post.');
            if(empty($post['email'])){
                $this->error('邮箱不能为空');die;
            }
            if(empty($post['getcode'])){
                $this->error('验证码不能为空');die;
            }
            $row = $consumermodel->where(array('username'=>$post['email']))->find();
            if(!$row){
                $this->error('邮箱输入错误');
            }
            $verify = new Verify();
            if(!$verify->check($post['getcode'])){
                $this->error("验证码错误");die;
            }
            $this->ajaxReturn(array('status'=>1));
        }else{
           $this->display(); 
        }    
    }

    public function findpwd2(){
        if(IS_POST){
            $consumermodel = M('consumer');
            $post = I('post.');
            if(!$post){
                $this->error('参数错误');
            }
            $row = $consumermodel->where(array('username'=>$post['email']))->find();
            if(!$row){
                $this->error('邮箱号输入错误');
            }
            $epwd = array('email'=>$post['email'],'id'=>$row['id']);
            $this->assign('epwd',$epwd);
            $this->display('login/findpwd3');
        }else{
            $this->display();
        }       
    }

    public function findpwd3(){
        $consumermodel = M('consumer');          
        $post = I('post.');
        if($post['pwd'] != $post['repwd']){
            $this->error('两次输入密码不一致');
        }
        $salt = getsalt();
        $savepwd = array(
            'id'=>$post['id'],
            'salt'=>$salt
            );
        $savepwd['password'] = generateHash($post['pwd'],$salt);
        $rew = $consumermodel->save($savepwd);
        if(!$rew){
            $this->error($consumermodel->getError());
        }
        $this->success('密码重置成功',U('login/login'));
        
    }








}
