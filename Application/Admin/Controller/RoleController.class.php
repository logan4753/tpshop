<?php
namespace Admin\Controller;
use Think\Controller;

class RoleController extends BaseController {

    public function rolelist(){
    	$params = I('post.');
		$model = M('role');
		$where = array();
		$where['status'] = 1;
		if(!empty($params['rolename'])){
			$where['rolename'] = array('like','%'.$params['rolename'].'%');
		}
		$count = $model -> where($where) -> count();
		$page = getPage($count,10);
		$show = $page -> show();
		$data = $model -> where($where) -> limit($page->firstRow,$page->listRows) -> select();
		$this -> assign('params',$params);
		$this -> assign('count',$count);
		$this -> assign('show',$show);
		$this -> assign('data',$data);
		$this -> display();  	
    }

    public function roleadd(){
    	if(IS_POST){
    		$model = M('role');
            $data = $model -> create(); //不传递参数则接受post数据
            if(!$data) {
                $this -> error($model -> getError()); die;
            }
            //dump($data); die;
            $result = $model -> add();
            if ($result) {
                $this->success('添加成功',U('role/rolelist'),3);
            } else {
                $this->error('添加失败');
            }
    	}else{
	    	$power = M('permission') -> field('id,pername name,pid') -> where(array('status'=>1)) -> select();
	    	$data = getTree2($power);
	    	$this -> assign('data',json_encode($data));
	    	$this -> display();
    	}
    }

    public function roleedit(){
    	if(IS_POST){
    		$post = I('post.');
    		$model = M('role');
    		//dump($post);die;
            $result = $model -> save($post);
            if($result !== fasle) {
                $this->success('修改成功',U('rolelist'),3);
            }
            else {
                $this->error('修改失败');
            }
    	}else{
    	    $id = I('id',0);
			$row = M('role') -> where(array('id'=>$id)) -> find();
	    	$arr = explode(',',$row['power']);
			$power = M('permission') -> field('id,pername name,pid') -> where(array('status'=>1))->select();
			foreach($power as $k => $v){
	    		if(in_array($v['id'],$arr)){
	    			$power[$k]['checked'] = true;
	    		}
	    	}
	    	$data = getTree2($power);
	    	$this -> assign('row',$row);
	    	$this -> assign('data',json_encode($data));
			$this -> display('');	
    	}
    }

    public function roledel(){
    	$id = I('id',0);
		if(empty($id)){
            $this->error('参数错误');
        }
        $model = M('role');
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