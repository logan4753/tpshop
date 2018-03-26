<?php
namespace Admin\Controller;

class CateController extends BaseController{
    /*分类列表*/
	public function categorylist(){
		$model = M('category');
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
		$model = M('category');
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
        //dump($list);die;
		header("Content-Type:text/html;charset=utf-8");
		echo json_encode(array_values($list));
	}
    /*修改分类状态*/
    public function ishot(){
        $id = I('id',0);
        $model = M('category');
        $catestatus = $model->where(array('id'=>$id))->getField("ishot");
        $params['ishot'] = $catestatus == 1 ? 2 : 1;
        $ret = $model->where(array('id'=>$id))->save($params);
        $this->ajaxReturn(array('status'=>1,'info'=>'操作成功','data'=>$params['ishot']));
    }
    /*添加分类*/
	public function categoryadd(){
		$model = M('category');
		if(IS_POST){
			$data = $model -> create();
    		if(!$data) {
                $this -> error($model -> getError()); die;
            }
            $result = $model -> add();
            if ($result) {
                $this -> success('添加成功',U('cate/categorylist'),3);
            } else {
                $this -> error('添加失败');
            }
		}else{
			$data = $model -> where(array('status' => 1)) -> select();
    		$data = getTree($data);
    		$this -> assign('data',$data);
			$this -> display();	
		}
	}
    /*修改分类*/
    public function categoryedit(){
    	if(IS_POST){
    		$post = I('post.');
    		$model = M('category');
    		//dump($post);die;
            $result = $model -> save($post);
            if($result !== fasle) {
                $this->success('修改成功',U('categorylist'),3);
            }
            else {
                $this->error('修改失败');
            }
    	}
    	$id = I('get.id');
    	$model = M('category');
    	$row = $model -> where(array('id' => $id)) -> find();
    	$data = $model -> where(array('status' => 1,'status' => 1)) -> select();
    	$data = getTree($data);
    	$this -> assign('data',$data); 
    	$this -> assign('row',$row);
    	$this -> display();
    }	
    /*删除分类*/
    public function categorydel(){
    	$id = I('id',0);
		if(empty($id)){
            $this->error('参数错误');
        }
        $model = M('category');
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