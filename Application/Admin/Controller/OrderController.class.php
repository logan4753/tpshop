<?php
namespace Admin\Controller;

class OrderController extends BaseController{
	/*订单列表*/
	public function orderlist(){
		$ordermodel = M('saleorder');
		$usermodel = M('consumer');
		$where = array();
		$count = $ordermodel->where($where)->count();
		$orderlists = $ordermodel->where($where)->select();
		foreach($orderlists as $k => $v){
			$orderlists[$k]['username'] = $usermodel->where(array('id'=>$v['userid']))->getField('username');
		}
		//dump($orderlists);die;
		$this->assign('count',$count);
		$this->assign('orderlists',$orderlists);
		$this->display();
	}
	/*删除订单*/
	public function orderstatus(){
		$id = I('id',0);
		if(!$id){
			$this->error('参数错误');
		}
		$ordermodel = M('saleorder');
		$orderstatus = $ordermodel->where(array('id'=>$id))->getField("status");
		$params['status'] = $orderstatus == 1 ? 2 : 1;
		$ret = $ordermodel->where(array('id'=>$id))->save($params);
		$this->ajaxReturn(array('status'=>1,'info'=>'操作成功','data'=>$params['status']));
	}
	/*修改订单信息*/
	public function orderedit(){
		$ordermodel = M('saleorder');
		$usermodel = M('consumer');
		if(IS_POST){
			$post = I('post.');
			//dump($post);die;
			$result = $ordermodel->save($post);
			if($result) {
                $this->ajaxReturn(array('status'=>1,'info'=>'操作成功'));
            }else {
                $this->error($ordermodel->getError());
            }
		}else{
			$id = I('id',0);
			if(!$id){
				$this->error('参数错误');
			}
			$row = $ordermodel->where(array('id'=>$id))->find();
			$row['username'] = $usermodel->where(array('id'=>$row['userid']))->getField('username');
			//dump($row);die;
			$this->assign('row',$row);
			$this->display();
		}		
	}
	/*订单详细信息*/
	public function orderinfo(){
		$ordermodel = M('saleorder');
		$infomodel = M('salesitem');
		$id = I('id',0);
		if(!$id){
			$this->error('参数错误');
		}
		$torder = $ordermodel->where(array('id'=>$id))->find();
		$ordergo = $infomodel->where(array('orderid'=>$id))->select();
		$this->assign('torder',$torder);
		$this->assign('ordergo',$ordergo);
		$this->display();
	}










}