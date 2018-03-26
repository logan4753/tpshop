<?php
namespace Home\Controller;
use Think\Controller;

class CartController extends Controller {
	/*登录验证*/
	function __construct(){
		parent::__construct();
		if(!session('front.userid')){
            $this->error('请登录',U('login/login'));
        }
	}
	/*加入购物车*/
	public function cartadd(){
		$post = I('post.');
		if(!$post){
			$this->error(array('data'=>2,'status'=>'参数错误'));die;
		}
		$cartmodel = M('cartitem');
		$goodsmodel = M('goods');
		$lists = $cartmodel->where(array('goodsid'=>$post['cartid'],'userid'=>session('front.userid'),'isorder'=>1))->find();
		if(empty($lists)){
			$data = array(
					'goodsid'=>$post['cartid'],
					'gcount'=>$post['cartcount'],
					'userid'=>session('front.userid')
				);
			$result = $cartmodel->add($data);
			if($result){
				$cart = getcart();
				//dump($cart);die;
				$this->ajaxReturn(array('status'=>1,'data'=>'加入购物车成功','cart'=>$cart));
			}else{
				$this->ajaxReturn(array('status'=>2,'data'=>'加入购物车失败'));die;
			}
		}else{
			$lists['gcount']+=$post['cartcount'];
			$result = $cartmodel->save($lists);
			if($result){
				$cart = getcart();
				//dump($cart);die;
				$this->ajaxReturn(array('status'=>1,'data'=>'加入购物车成功','cart'=>$cart));
			}else{
				$this->ajaxReturn(array('status'=>2,'data'=>'加入购物车失败'));die;
			}
		}
		S('cart',null);
	}
	/*商品数量及状态修改*/
	public function number(){
		$cartmodel = M('cartitem');
		$post = I('post.');
		if($post['act'] == 'plus'){
			$carts = $cartmodel->where(array('goodsid'=>$post['id'],'isorder'=>1))->find();
			$carts['gcount'] += 1;
		}elseif($post['act'] == 'minus'){
			$carts = $cartmodel->where(array('goodsid'=>$post['id'],'isorder'=>1))->find();
			$carts['gcount'] -= 1;
		}elseif($post['act'] == 'uncheck'){
			$carts = $cartmodel->where(array('goodsid'=>$post['id'],'isorder'=>1))->find();
			$carts['status'] = 2;
		}elseif($post['act'] == 'docheck'){
			$carts = $cartmodel->where(array('goodsid'=>$post['id'],'isorder'=>1))->find();
			$carts['status'] = 1;
		}	
		$cartmodel->save($carts);
		$goods = getcart(array('status'=>1));
		S('cart',null);
		//dump($carts);die;
		$this->ajaxReturn(array('status'=>1,'goodslist'=>$goods['goodslist'],'gcount'=>$goods['goodscount'],'pricesum'=>$goods['pricesum']));
		
	}
	/*购物车页面*/
	public function cartorder(){
		$cart = getcart();
		$where = array('status'=>1);
		$oncart = getcart($where);
		$this->assign('goodslist',$cart['goodslist']);
		$this->assign('goodscount',$oncart['goodscount']);
		$this->assign('pricesum',$oncart['pricesum']);		
		$this->display();
	}
	/*商品删除*/
	public function goodsdel(){
		$id = I('id',0);
		if(!$id){
			$this->error('参数错误');
		}
		$cartmodel = M('cartitem');
		$res = $cartmodel->where(array('goodsid'=>$id))->delete();
		if(!$res){
        	$this->error($cartmodel->getError());
    	}
    	$nowcart = getcart();
    	//dump($nowcart);die;
    	$this->ajaxReturn(array('status'=>1,'info'=>'删除成功','goodscount'=>$nowcart['goodscount'],'pricesum'=>$nowcart['pricesum']));
	}
	/*订单提交页*/
	public function ordersale(){
		$addmodel = M('address');
		$address = $addmodel->where(array('userid'=>session('front.userid')))->select();
		$goodslist = getcart(array('status'=>1));
		// dump($address);die;
		$this->assign('goodslist',$goodslist);
		$this->assign('address',$address);
		$this->display();
	}
	/*提交订单生成订单*/
	public function orderadd(){
		$post = I('post.');
		$addressmodel = M('address');
		$cartmodel = M('cartitem');
		$saleordermodel = M('saleorder');
		$salesitemmodel = M('salesitem');
		$recipient = $addressmodel->where(array('id'=>$post['onadd']))->find();
		$carts = getcart(array('status'=>1));
		$saleordermodel->startTrans();
		$cartmodel->startTrans();
		$salesitemmodel->startTrans();
		$ordernum = date('YmdHis').mt_rand(10000,99999);
		$saleorder = array(
				'ordernum' => $ordernum,
				'userid' => session('front.userid'),
				'address' => $recipient['address'].$recipient['addressinfo'],
				'recieve' => $recipient['recieve'],
				'tel' => $recipient['tel'],
				'odate' => time(),
				'allprice' => $carts['pricesum'],
				'remark' => $post['remark']	
			);
		$result = $saleordermodel->add($saleorder);
		if(!$result){
			$saleordermodel->rollback();die;
		}
		$salesitem = array();
		foreach($carts['goodslist'] as $k => $v){
			$salesitem[$k]['goodsid'] = $v['goodsid'];
			$salesitem[$k]['gname'] = $v['goodsname'];
			$salesitem[$k]['gprice'] = $v['shopprice'];
			$salesitem[$k]['gimage'] = $v['image'];
			$salesitem[$k]['gcount'] = $v['gcount'];
			$salesitem[$k]['orderid'] = $result;
		}
		$res = $salesitemmodel->addAll($salesitem);
		if(!$res){
			$saleordermodel->rollback();
			$salesitemmodel->rollback();die;
		}
		$isorder = array('isorder'=>2);
		$iswhere = array();
		foreach($carts['goodslist'] as $k => $v){
			$iswhere[] = $v['id'];
		}
		$iswhere = implode(',',$iswhere);
		$where['id'] = array('in',$iswhere);
		$ret = $cartmodel->where($where)->save($isorder);
		if(!$ret){
			$saleordermodel->rollback();
			$salesitemmodel->rollback();
			$cartmodel->rollback();die;
		}else{
			$saleordermodel->commit();
			$salesitemmodel->commit();
			$cartmodel->commit();
			$this->ajaxReturn(array('status'=>1));
		}		
	}
	/*支付页*/
	public function orderpay(){
		$saleordermodel = M('saleorder');
		$post = I('post.');
		if($post){
			$neworder = $saleordermodel->where(array('ordernum'=>$post['ordernum']))->find();
		}else{
			$neworder = $saleordermodel->where(array('userid'=>session('front.userid')))->order('odate desc')->find();
		}
		//dump($neworder);die;
		$this->assign('neworder',$neworder);
		$this->display();
	}
	/*支付*/
	public function dopay(){
		$post = I('post.');
		//dump($post);die;
		$saleordermodel = M('saleorder');
		$theorder = $saleordermodel->where(array('ordernum'=>$post['ordernum']))->find();
		$dopay = array(
				'id'=>$theorder['id'],
				'ispay'=>1
			);
		$res = $saleordermodel->save($dopay);
		if(!$res){
			$this->error($saleordermodel->getError());
		}
		$this->ajaxReturn(array('status'=>1));
	}
	/*确认收货*/
	public function dosend(){		
		$ordermodel = M('saleorder');
		$id = I('id',0);
		$send = array('send'=>3);
		$res = $ordermodel->where(array('id'=>$id))->save($send);
		if(!$res){
			$this->error($ordermodel->getError());
		}
		$this->ajaxReturn(array('status'=>1));
	}


}