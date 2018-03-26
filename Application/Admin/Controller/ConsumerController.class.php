<?php
namespace Admin\Controller;

class ConsumerController extends BaseController{
	/*用户列表*/
	public function consumerlist(){
		$model = M('consumer');
		$where = array();	
		$count = $model->where($where)->count();	
		$data = $model->where($where)->select();
		//dump($data);die;
		$this->assign('count',$count);
		$this->assign('data',$data);
		$this->display();
	}
	/*用户详细信息*/
	public function consumerinfo(){
		$model = M('consumer');
		$id = I('id',0);
		if(!$id){
			$this->error('参数错误');
		}
		$info = $model->where(array('id'=>$id))->find();
		$info['photo'] = '/Public'.ltrim($info['photo'],'.');
		//dump($info);die;
		$this->assign('info',$info);
		$this->display();
	}
	/*修改密码*/
	public function editpwd(){
		if(IS_POST){
			$consumermodel = M('consumer');
			$post = I('post.');
			if($post['pwd'] != $post['repwd']){
				$this->error('两次输入密码不一致');
			}
			$dopwd = array('id'=>$post['id']);
			$dopwd['salt'] = getsalt();
			$dopwd['password'] = generateHash($post['pwd'],$dopwd['salt']);
			$ret = $consumermodel->save($dopwd);
			if(!$ret){
				$this->error($consumermodel->getError());
			}
			$this->ajaxReturn(array('status'=>1));
		}else{
			$id = I('id',0);
			$this->assign('id',$id);
			$this->display();
		}
	}






}