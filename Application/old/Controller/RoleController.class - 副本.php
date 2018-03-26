<?php
namespace Admin\Controller;
use Think\Controller;
header("content-type:text/html;charset=utf-8");
class RoleController extends Controller {

    public function rolelist(){
    	$model = M('role');
    	$data = $model->select();
    	$this->assign('data',$data);
        $this->display();  	
    }

    public function roleadd(){
    	$power = M('permission')->field('id,pername name,pid')->where(array('status'=>1))->select();
    	$data = getTree2($power);
    	//dump($data);die;
    	$this->assign('data',json_encode($data));    	
    	$this->display();
    }

    public function rolesave(){
    	$params = I('post.');
    	$id = I('id',0);    	
    	$data['rolename'] = $params['rolename'];
    	$data['power'] = $params['power'];
    	$data['info'] = $params['info'];
    	$data['status'] = $params['info'];
    	$model = M('role');
    	$result = $model->create();
    	//dump($result);die;
    	if($result){
    		if(empty($id)){
    			$model->add();
    		}else{
    			$model->save();
    		}
    		$this->success('操作成功');
    	}else{
    		$this->error($model->getError());
    	}    	    	
    }

    public function roleedit(){
    	$id = I('id',0);
    	if(empty($id)){
    		$this->error('参数错误');
    	}
    	$row = M('role')->where(array('id'=>$id))->find();
    	$arr = explode(',',$row['power']);
    	$power = M('permission')->field('id,pername name,pid')->where(array('status'=>1))->select();
    	foreach($power as $k => $v){
    		if(in_array($v['id'],$arr)){
    			$power[$k]['checked'] = true;
    		}
    	}
    	$data = getTree2($power);
    	//dump($data);die;
    	$this->assign('row',$row);
    	$this->assign('data',json_encode($data));   	
    	$this->display('roleadd');
    }



}