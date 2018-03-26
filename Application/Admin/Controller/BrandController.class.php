<?php
namespace Admin\Controller;
use Think\Upload;
use Think\Image;

class BrandController extends BaseController{
	/*品牌列表*/
	public function brandlist(){
		$model = M('brand');
		$where = array('status'=>1);
		$count = $model->where($where)->count();
		$page = getPage($count,15);
		$show = $page->show();
		$data = $model->where($where)->limit($page->firstRow,$page->listRows)->select();
		foreach($data as $k => $v){
			$data[$k]['photo'] = '/Public'.ltrim($v['photo'],'.');
		}//dump($data);die;
		$this->assign('count',$count);
		$this->assign('show',$show);
		$this->assign('data',$data);
		$this -> display();
	}
	/*添加品牌*/
	public function brandadd(){
		if(IS_POST){
			$model = M('brand');
			$post = I('post.');
			$upload = new \Think\Upload();
			$upload->exts = array('jpg', 'gif', 'png', 'jpeg');
			$upload->rootPath = './Public/';
			$upload->savePath = "./Uploads/";
			$upload->saveName = time().'_'.mt_rand(1000,9999);		
			$info = $upload -> uploadOne($_FILES['file-1']);
			if(!$info){
				$this->error($upload->getError());
			}
			$post['photo'] = $info['savepath'].$info['savename'];
			$data = $model -> create($post);
    		if(!$data) {
                $this -> error($model -> getError()); die;
            }
            $result = $model -> add();
            if ($result) {
                $this -> ajaxReturn(array('status'=>1,'info'=>'操作成功'));
            } else {
                $this -> error('添加失败');
            }
		}else{
			$this -> display('brandadd');
		}
	}
	/*品牌信息修改*/
	public function brandedit(){
		$model = M('brand');
		if(IS_POST){
			$post = I('post.');
			$result = $model->save($post);
			if($result !== fasle) {
                $this->ajaxReturn(array('status'=>1,'info'=>'操作成功'));
            }else {
                $this->error('修改失败');
            }
		}else{
			$id = I('id',0);
			$row = $model->where(array('id'=>$id))->find();
			$this->assign('row',$row);
			$this->display();
		}
	}
	/*删除品牌*/
	public function branddel(){
		$id = I('id',0);
		if(empty($id)){
            $this->error('参数错误');
        }
        $model = M('brand');
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