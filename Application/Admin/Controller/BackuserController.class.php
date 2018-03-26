<?php
namespace Admin\Controller;
use Think\Controller;

class BackuserController extends BaseController {
	/*管理员列表*/
	public function userlist(){
		$params = I('post.');
		$model = M('backuser');
		$role_model = M('role');
		$where = array('del'=>1);
		if(!empty($params['username'])){
			$where['username'] = array('like','%'.$params['username'].'%');
		}
		if(!empty($params['realname'])){
			$where['realname'] = array('like','%'.$params['realname'].'%');
		}
		if(!empty($params['rolename'])){
			$role = $role_model->field('id')->where(array('rolename'=>array('like','%'.$params['rolename'].'%')))->find();
			$where['role'] = $role['id'];
		}
		$count = $model->where($where)->count();
		$page = getPage($count,10);
		$show = $page->show();
		$data = $model->where($where)->limit($page->firstRow,$page->listRows)->select();
		$rolelist = $role_model->getField('id,rolename');
		if(empty($params)){
			
		}
		$this->assign('params',$params);
		$this->assign('count',$count);
		$this->assign('rolelist',$rolelist);
		$this->assign('show',$show);
		$this->assign('data',$data);
		$this->display();
	}
	/*添加管理员*/
	public function useradd(){
		if(IS_POST){
			$params = I('post.');
			$model = M('backuser');
			$params['salt'] = getsalt();
			$params['password'] = generateHash($params['password'],$params['salt']);
            $data = $model -> create($params); //不传递参数则接受post数据
            if(!$data) {
                $this -> error($model -> getError()); die;
            }
            //dump($data); die;
            $result = $model -> add();
            if ($result) {
            	$this->ajaxReturn(array('status'=>1,'info'=>'操作成功'));
                //$this->success('添加成功',U('backuser/userlist'),3);
            } else {
                $this->error('添加失败');
            }
		}else{
			$data = M('role')->field('id,rolename')->where(array('status'=>1))->select();
    		$this->assign('data',$data);
			$this->display();			
		}

	}
	/*修改管理员信息*/
	public function useredit(){
		if(IS_POST){
			$post = I('post.');
			$model = M('backuser');
			//dump($post);die;
			$result = $model->save($post);
			if($result !== fasle) {
                $this->ajaxReturn(array('status'=>1,'info'=>'操作成功'));
            }
            else {
                $this->error('修改失败');
            }
		}else{
			$id = I('id',0);
			$model = M('backuser');
			$row = $model->where(array('id'=>$id))->find();
			$data = M('role')->field('id,rolename')->where(array('status'=>1))->select();
	    	$this->assign('data',$data);
	    	$this->assign('row',$row);
	    	$this->display();			
		}
	}
	/*修改管理员状态*/
	public function userstatus(){
		$id = I('id',0);
		$model = M('backuser');
		$userstatus = $model->where(array('id'=>$id))->getField("status");
		$params['status'] = $userstatus == 1 ? 2 : 1;
		$ret = $model->where(array('id'=>$id))->save($params);
		$this->ajaxReturn(array('status'=>1,'info'=>'操作成功','data'=>$params['status']));
	}
	/*修改密码*/
	public function pwdedit(){
		$model = M('backuser');
		$this->display();
	}
	/*删除管理员*/
	public function userdel(){
		$id = I('id',0);
		if(empty($id)){
            $this->error('参数错误');
        }
        $model = M('backuser');
        $id = explode(',',$id);
        //dump($id);die;
        foreach($id as $k => $v){
        	$list = array('del'=>2);
        	$result = $model->where(array('id'=>$v))->save($list);
        }
        if($result){          
        	$this->ajaxReturn(array('status'=>1,'info'=>'操作成功'));
    	}else{
        	$this->error($model->getError());
    	} 
	}


	

}