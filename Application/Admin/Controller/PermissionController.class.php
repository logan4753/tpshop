<?php
namespace Admin\Controller;
use Think\Controller;

class PermissionController extends BaseController {

	public function permissionlist(){
		$model = M('permission');
		$count = $model -> count();
		$data = $model -> where(array('pid' => 0,'status' => 1))->select();
		if(is_array($data)){
			foreach($data as $k => $v){
				$data[$k]['switchs'] = 0;
				$all = $model -> where(array('pid' => $v['id'],'status' => 1)) -> select();
				if(!empty($all)){
				   $data[$k]['switchs'] = 1;
				}
			}
		}
		//dump($data);die;
		$this -> assign('count',$count);
		$this -> assign('data',$data);
		$this -> display();
	}

	public function getchild(){
		$model = M('permission');
		$id = I('id',0);
		if(empty($id)){
			return false;
		}
		$list = $model -> where(array('pid'=>$id,'status' => 1)) -> select();
		if(is_array($list)){
			foreach($list as $k => $v){
				$list[$k]['switchs'] = 0;
				$all = $model -> where(array('pid' => $v['id'],'status' => 1)) -> select();
				if(!empty($all)){
					$list[$k]['switchs'] = 1;
				}
			}
		}
		header("Content-Type:text/html;charset=utf-8");
		echo json_encode(array_values($list));
		die;
	}

    public function permissionadd(){
    	$model = M('permission');
    	if(IS_POST){    		
    		$data = $model -> create();
    		if(!$data) {
                $this -> error($model -> getError()); die;
            }
            $result = $model -> add();
            if ($result) {
                $this -> success('添加成功',U('permission/permissionlist'),3);
            } else {
                $this -> error('添加失败');
            }
    	}
    	$data = $model -> where(array('status' => 1)) -> select();
    	$data = getTree($data);
    	$this -> assign('data',$data);
    	$this -> display();
    }

    public function permissionedit(){
    	if(IS_POST){
    		$post = I('post.');
    		$model = M('permission');
    		//dump($post);die;
            $result = $model -> save($post);
            if($result !== fasle) {
                $this->success('修改成功',U('permissionlist'),3);
            }
            else {
                $this->error('修改失败');
            }
    	}
    	$id = I('get.id');
    	$model = M('permission');
    	$row = $model -> where(array('id' => $id)) -> find();
    	$data = $model -> where(array('status' => 1,'status' => 1)) -> select();
    	$data = getTree($data);
    	$this -> assign('data',$data); 
    	$this -> assign('row',$row);
    	$this -> display();
    }

    public function permissiondel(){
    	$id = I('id',0);
		if(empty($id)){
            $this->error('参数错误');
        }
        $model = M('permission');
        $id = explode(',',$id);
        //dump($id);die;
        foreach($id as $k => $v){
        	$list = array('status'=>2);
        	$result = $model->where(array('id'=>$v))->save($list);
        }
        if($result){          
        	$this->ajaxReturn(array('status'=>1,'info'=>'操作成功'));
    	}else{
        	$this->error($model->getError());
    	}       
    }







}