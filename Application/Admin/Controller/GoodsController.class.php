<?php
namespace Admin\Controller;
use Think\Controller;

class GoodsController extends BaseController{

	public function goodslist(){
		$params = I('post.');
		$model = M('goods');
		$catemodel = M('category');
		$brandmodel = M('brand');
		$where = array('status'=>1);
		if(!empty($params['goodsname'])){
			$where['goodsname'] = array('like','%'.$params['goodsname'].'%');
		}
		if(!empty($params['category'])){
			$cate = $catemodel->field('id')->where(array('catename'=>$params['category']))->find();
			$where['category'] = $cate['id'];
		}
		if(!empty($params['brand'])){
			$brand = $brandmodel->field('id')->where(array('brandname'=>array('like','%'.$params['brand'].'%')))->find();
			$where['brand'] = $brand['id'];
		}//dump($where);die;
		$count = $model->where($where)->count();
		$page = getPage($count,15);
		$show = $page->show();
		$data = $model->where($where)->limit($page->firstRow,$page->listRows)->select();
		foreach($data as $k => $v){
			$data[$k]['image'] = '/Public'.ltrim(substr($v['image'],0,40),'.');
		}
		$catelist = $catemodel->getField('id,catename');
		$brandlist = $brandmodel->getField('id,brandname');
		$this->assign('params',$params);
		$this->assign('count',$count);
		$this->assign('catelist',$catelist);
		$this->assign('brandlist',$brandlist);
		$this->assign('show',$show);
		$this->assign('data',$data);
		$this->display();
	}

	public function goodsadd(){
		if(IS_POST){
			$model = M('goods');
			$catemodel = M('category');
			$post = I('post.');
			//dump($post);die;
			$cate = $catemodel->field('id,pid')->where(array('id'=>$post['category']))->find();
			if(!empty($cate)){
				$post['cate'] = $cate['pid'];
				$cate1 = $catemodel->field('id,pid')->where(array('id'=>$cate['pid']))->find();
				if(!empty($cate1)){
					$post['cate1'] = $cate1['pid'];
				}
			}
			$files = $_FILES;
			$imagearr = array();
			foreach($files as $k => $v){
				foreach($v as $key => $val){
					foreach($val as $kk => $vv){
						$imagearr[$kk]['name'] = $v['name'][$kk];
						$imagearr[$kk]['type'] = $v['type'][$kk];
						$imagearr[$kk]['tmp_name'] = $v['tmp_name'][$kk];
						$imagearr[$kk]['error'] = $v['error'][$kk];
						$imagearr[$kk]['size'] = $v['size'][$kk];
					}
				}
			}//dump($imagearr);die;
			$upload = new \Think\Upload();			
			$info = array();				
			foreach($imagearr as $key => $val){
				$upload->exts = array('jpg', 'gif', 'png', 'jpeg');
				$upload->rootPath = './Public/';
				$upload->savePath = "./Uploads/";
				$upload->saveName = time().'_'.mt_rand(1000,9999);
				$info[] = $upload -> uploadOne($val);
			}//dump($post);dump($info);die;
			if(!$info){
				$this->error($upload->getError());
			}
			foreach($info as $k => $v){
				$image[] = $v['savepath'].$v['savename'];
			}//dump($image);die;
			$post['image'] = implode(',',$image);
			//dump($post1);dump($post2);die;
			$data = $model -> create($post);
			
    		if(!$data) {
                $this -> error($model -> getError()); die;
            } 
            $result = $model -> add();
            if ($result) {
                $this ->success('操作成功','goodslist');
            } else {
                $this -> error('添加失败');
            }
		}else{
			$catemodel = M('category');
			$brandmodel = M('brand');
			$catearr = $catemodel->where(array('status'=>1))->select();
			$brandarr = $brandmodel->where(array('status'=>1))->select();
			$catearr = getTree($catearr);
			$this->assign('catearr',$catearr);
			$this->assign('brandarr',$brandarr);
			$this->display();
		}
	}

	public function goodsedit(){
		$model = M('goods');
		if(IS_POST){
			$catemodel = M('category');
			$post = I('post.');
			//dump($post);die;
			$cate = $catemodel->field('id,pid')->where(array('id'=>$post['category']))->find();
			if(!empty($cate)){
				$post['cate'] = $cate['pid'];
				$cate1 = $catemodel->field('id,pid')->where(array('id'=>$cate['pid']))->find();
				if(!empty($cate1)){
					$post['cate1'] = $cate1['pid'];
				}
			}
			$files = $_FILES;
			if(!empty($files)){
				$imagearr = array();
				foreach($files as $k => $v){
					foreach($v as $key => $val){
						foreach($val as $kk => $vv){
							$imagearr[$kk]['name'] = $v['name'][$kk];
							$imagearr[$kk]['type'] = $v['type'][$kk];
							$imagearr[$kk]['tmp_name'] = $v['tmp_name'][$kk];
							$imagearr[$kk]['error'] = $v['error'][$kk];
							$imagearr[$kk]['size'] = $v['size'][$kk];
						}
					}
				}//dump($imagearr);die;
				$upload = new \Think\Upload();			
				$info = array();				
				foreach($imagearr as $key => $val){
					$upload->exts = array('jpg', 'gif', 'png', 'jpeg');
					$upload->rootPath = './Public/';
					$upload->savePath = "./Uploads/";
					$upload->saveName = time().'_'.mt_rand(1000,9999);
					$info[] = $upload -> uploadOne($val);
				}//dump($post);dump($info);die;
				if(!$info){
					$this->error($upload->getError());
				}
				foreach($info as $k => $v){
					$image[] = $v['savepath'].$v['savename'];
				}//dump($image);die;
				$post['image'] = implode(',',$image);
			}else{
				unset($post['image']);
				unset($post['file']);
			}			
			//dump($post1);dump($post2);die;
			$data = $model -> create($post);
			
    		if(!$data) {
                $this -> error($model -> getError()); die;
            } 
            $result = $model -> save();
            //dump($data);die;
            if ($result!==false) {
                $this ->ajaxReturn(array('status'=>1,'info'=>'操作成功'));
            } else {
                $this -> error('操作失败');
            }
		}else{
			$catemodel = M('category');
			$brandmodel = M('brand');
			$id = I('id',0);
			$row = $model->where(array('id'=>$id))->find();
			$catearr = $catemodel->where(array('status'=>1))->select();
			$brandarr = $brandmodel->where(array('status'=>1))->select();
			$catearr = getTree($catearr);
			$this->assign('catearr',$catearr);
			$this->assign('brandarr',$brandarr);
			$this->assign('row',$row);
			$this->display();			
		}
	}

	public function goodsdel(){
		$id = I('id',0);
		if(empty($id)){
            $this->error('参数错误');
        }
        $model = M('goods');
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