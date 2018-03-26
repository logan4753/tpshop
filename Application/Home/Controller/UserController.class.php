<?php
namespace Home\Controller;
use Think\Controller;
use Think\Upload;

class UserController extends Controller {
	/*登录验证*/
	function __construct(){
		parent::__construct();
		if(!session('front.userid')){
            $this->error('请登录',U('login/login'));
        }
	}
	/*个人信息页*/
	public function userinfo(){
		$usermodel = M('consumer');
		if(IS_POST){
			$post = I('post.');
			$photo = $_FILES['photo'];
			if(!empty($photo['name'])){
				$upload = new \Think\Upload();
				$upload->exts = array('jpg', 'gif', 'png', 'jpeg');
				$upload->rootPath = './Public/';
				$upload->savePath = "./Uploads/";
				$upload->saveName = time().'_'.mt_rand(1000,9999);		
				$info = $upload -> uploadOne($photo);
				if(!$info){
					$this->error($upload->getError());
				}
				$post['photo'] = $info['savepath'].$info['savename'];
			}
			$dre = $usermodel ->save($post);
			if(!$dre){
				$this->error($usermodel->getError());
			}
		}
		$row = $usermodel->where(array('id'=>session('front.userid')))->find();
		$row['photo'] = '/Public'.ltrim($row['photo'],'.');
		$this->assign('row',$row);
    	$this->display();		
	}
	/*收货地址页*/
	public function address(){
		$addressmodel = M('address');
    	$myadd = $addressmodel->where(array('userid'=>session('front.userid')))->select();
    	$this->assign('myadd',$myadd);
		$this->display();				
	}
	/*添加收货地址*/
	public function addaddress(){
		$post = I('post.');
		$regionmodel = M('region');
		$addressmodel = M('address');
		$pro = $regionmodel->where(array('region_id'=>$post['pro']))->getField('region_name');
		$city = $regionmodel->where(array('region_id'=>$post['city']))->getField('region_name');
		$coun = $regionmodel->where(array('region_id'=>$post['coun']))->getField('region_name');
		$address = array(
				'userid'=>session('front.userid'),
				'recieve'=>$post['recieve'],
				'postcode'=>$post['postcode'],
				'tel'=>$post['tel'],
				'address'=>$pro.$city.$coun,
				'addressinfo'=>$post['address']
			);
		//dump($address);die;
		$result = $addressmodel->add($address);
		if(!$result){
			$this->error($addressmodel->getError());
		}
		$this->ajaxReturn(array('status'=>1));
	}

	public function getregion(){
		$regionmodel = M('region');
		$post = I('post.');
		$region = $regionmodel->where(array('parent_id'=>$post['pid']))->select();
		$this->ajaxReturn(array('region'=>$region));
	}
	/*删除收货地址*/
	public function adddel(){
		$addressmodel = M('address');
		$id = I('id',0);
		if(!$id){
			$this->error('参数错误');
		}
		$result = $addressmodel->where(array('id'=>$id))->delete();
		if(!$result){
			$this->error($addressmodel->getError());die;
		}
		$this->ajaxReturn(array('status'=>1));
	}
	/*设置默认收货地址*/
	public function setsta(){
		$id = I('id',0);
		if(!$id){
			$this->error('参数错误');
		}
		$addmodel = M('address');
		$doset = array('status'=>1);
		$osta = $addmodel->where(array('userid'=>session('front.userid'),'status'=>1))->find();
		if($osta){
			$osta['status'] = 2;
			$rel = $addmodel->save($osta);		
			if(!$rel){
				$this->error($addmodel->getError());
			}
		}
		$reu = $addmodel->where(array('id'=>$id))->save($doset);
		//dump($reu);die;
		if(!$reu){
			$this->error($addmodel->getError());
		}
		$this->ajaxReturn(array('status'=>1));
	}
	/*我的订单*/
	public function myorder(){
		$saleordermodel = M('saleorder');
		$salesitemmodel = M('salesitem');
		$allorder = $saleordermodel->where(array('userid'=>session('front.userid')))->order('odate desc')->select();
		foreach($allorder as $key => $val){
			$allorder[$key]['ondate'] = date('Y-m-d H:i:s',$val['odate']);
			$allorder[$key]['child'] = $salesitemmodel->where(array('orderid'=>$val['id']))->select();
		}
		//dump($allorder);die;
		$this->assign('allorder',$allorder);	
		$this->display();
	}
	/*我的收藏*/
	public function mycollect(){
		$collectmodel = M('collect');
		$goodsmodel = M('goods');
		$mykeep = $collectmodel->where(array('userid'=>session('front.userid')))->getField('id,goodsid');
		if($mykeep){
			$keepid = implode(',',$mykeep);
			$keeps = $goodsmodel->field('id,goodsname,shopprice,image,comment')->where(array('id'=>array('in',$keepid)))->select();
			foreach($keeps as $k => $v){
				if(mb_strlen($v['goodsname'],'utf8')>=40){
					$keeps[$k]['aname'] = mb_substr($v['goodsname'],0,40,'utf8').'…';
				}else{
					$keeps[$k]['aname'] = $v['goodsname'];				
				}
				$keeps[$k]['image'] = '/Public'.ltrim(substr($v['image'],0,40),'.');
			}
			//dump($mykeep);dump($keeps);die;
			$this->assign('keeps',$keeps);
		}		
		$this->display();
	}
	/*取消收藏*/
	public function uncollect(){
		$collectmodel = M('collect');
		$id = I('id',0);
		if(!$id){
			$this->error('参数错误');
		}
		$thecol = $collectmodel->where(array('userid'=>session('front.userid'),'goodsid'=>$id))->find();
		//dump($thecol);die;
		$red = $collectmodel->delete($thecol['id']);
		if(!$red){
			$this->error($collectmodel->getError());
		}
		$this->ajaxReturn(array('status'=>1));
	}
	/*添加收藏*/
	public function addcol(){
		$collectmodel = M('collect');
		$goodsid = I('post.');
		$alorder = $collectmodel->where(array('userid'=>session('front.userid')))->getField('goodsid',true);
		if(in_array($goodsid['colid'],$alorder)){
			$this->ajaxReturn(array('status'=>2));die;
		}
		$coladd = array(
			'userid' => session('front.userid'),
			'goodsid' => $goodsid['colid']
			);
		$rev = $collectmodel->add($coladd);
		if(!$rev){
			$this->error($collectmodel->getError());
		}
		$this->ajaxReturn(array('status'=>1));
	}
	/*我的优惠券*/
	public function mycoupon(){
		$this->display();
	}
	/*修改密码*/
	public function editpwd(){
		if(IS_POST){
			$post = I('post.');
			$usermodel = M('consumer');
			$myinfo = $usermodel->where(array('id'=>session('front.userid')))->find();
			$osalt = generateHash($post['opwd'],$myinfo['salt']);
			if($osalt != $myinfo['password']){
				$this->error('原密码输入错误');die;
			}
			if($post['npwd'] != $post['renpwd']){
				$this->error('两次密码不一致');die;
			}
			$doedit = array('id'=>$myinfo['id']);
			$doedit['salt'] = getsalt();
			$doedit['password'] = generateHash($post['npwd'],$doedit['salt']);
			$result = $usermodel->save($doedit);
			if(!$result){
				$this->error('密码修改失败');die;
			}
			session('front.userid',null);
			session('front.username',null);
			$this->success('修改成功',U("Login/login"));
		}else{
			$this->display();
		}		
	}
	/*取消订单*/
	public function orderaway(){
		$id = I('id',0);
		if(!$id){
			$this->error('参数错误');
		}
		$ordermodel = M('saleorder');
		$rew = $ordermodel->where(array('id'=>$id))->save(array('status'=>2));
		if(!$rew){
			$this->error($ordermodel->getError());
		}
		$this->ajaxReturn(array('status'=>1));
	}
	/*评价页*/
	public function comment(){
		$ordermodel = M('saleorder');
		$itemmodel = M('salesitem');
		$commodel = M('comments');
		$order = $ordermodel->where(array('userid'=>session('front.userid'),'send'=>3))->order('odate desc')->select();
		foreach($order as $key => $val){
			$order[$key]['ondate'] = date('Y-m-d H:i:s',$val['odate']);
			$order[$key]['child'] = $itemmodel->where(array('orderid'=>$val['id']))->select();
		}
		//dump($order);die;
		$this->assign('order',$order);
		$this->display();
	}
	/*评价*/
	public function docomment(){
		$commentmodel = M('comments');
		$itemmodel = M('salesitem');
		$post = I('post.');
		$file_infor = var_export($_FILES,true);
		dump($file_infor);die;
		if(!empty($photo['name'])){
			$upload = new \Think\Upload();
			$upload->exts = array('jpg', 'gif', 'png', 'jpeg');
			$upload->rootPath = './Public/';
			$upload->savePath = "./Uploads/";
			$upload->saveName = time().'_'.mt_rand(1000,9999);		
			$info = $upload -> uploadOne($photo);
			if(!$info){
				$this->error($upload->getError());
			}
			$post['photo'] = $info['savepath'].$info['savename'];
		}
		dump($post);die;
	}




}