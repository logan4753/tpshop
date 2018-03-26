<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends Controller {
    /*主页*/
    public function index(){
        $goodsmodel = M('goods');
        $brandmodel = M('brand');
        $brand = $brandmodel->getField('id,brandname');
        //dump($brand);die;
        $goodsshow = S('goodsshow');
        if(!$goodsshow){
            $goodsshow = $goodsmodel->where(array('commend'=>2))->select();
            foreach($goodsshow as $k => $v){
                $goodsshow[$k]['brandname'] = $brand[$v['brand']];
                $goodsshow[$k]['showimg'] = '/Public'.ltrim(substr($v['image'],0,40),'.');
                if(mb_strlen($v['goodsname'],'utf8')>12){
                    $goodsshow[$k]['aname'] = mb_substr($v['goodsname'],0,12,'utf8').'…';
                }else{
                    $goodsshow[$k]['aname'] = $v['goodsname'];
                }
            }
            S('goodsshow',$goodsshow);
        }
        //dump($goodsshow);die;
        $this->assign('goodsshow',$goodsshow);
        $this->display();  	
    }
    
    /*商品详情页*/
    public function getdetail(){
    	$id = I('id',0);
    	$catemodel = M('category');
    	$brandmodel = M('brand');
    	$goodsmodel = M('goods');
    	$goodsrow = $goodsmodel->where(array('id'=>$id))->find();
    	$brand = $brandmodel->where(array('id'=>$goodsrow['brand']))->find();
    	$cate = $catemodel->where(array('id'=>$goodsrow['category']))->find();
    	$catelist[1] = $cate;
    	$bcate = $catemodel->where(array('id'=>$cate['pid']))->find();
    	if(!empty($bcate)){
    		$catelist[2] = $bcate;
    		$fcate = $catemodel->where(array('id'=>$bcate['pid']))->find();
    		if(!empty($fcate)){
    			$catelist[3] = $fcate;
    		}
    	}
    	$catelist = array_reverse($catelist,true); 
    	//dump($catelist);die;
    	$image = explode(',',$goodsrow['image']);
    	for($i=0;$i<count($image);$i++){
    		$image[$i] = '/Public'.ltrim($image[$i],'.');
    	}    	
    	$imagecount = count(explode(',',$goodsrow['image']));
    	//dump($image);die;
    	$this->assign('catelist',$catelist);
    	$this->assign('goodsrow',$goodsrow);
    	$this->assign('brand',$brand);
    	$this->assign('image',$image);
    	$this->assign('imagecount',$imagecount);
    	$this->display();
    }
    /*商品列表页*/
    public function getgoods(){
        $catemodel = M('category');
        $brandmodel = M('brand');
        $goodsmodel = M('goods');
        $doser = I('request.');
        if(isset($doser['search'])){
            $wherearr = array();
            $brand = $brandmodel->where(array('brandname'=>$doser['search']))->find();
            if($brand){
                $wherearr['brand'] = $brand['id'];
            }
            $cate = $catemodel->where(array('catename'=>$doser['search']))->find();
            if($cate){
                $wherearr['category'] = $cate['id'];
                $wherearr['cate'] = $cate['id'];
                $wherearr['cate1'] = $cate['id'];
            }
            $wherearr['goodsname'] = array('like','%'.$doser['search'].'%');
            $wherearr['_logic'] = 'or';
            $goods = $goodsmodel->field('id,goodsname,shopprice,image,comment')->where($wherearr)->select();
            $whereshow['_complex'] = $wherearr;
            $whereshow['commend'] = 2;
            $goodsshow = $goodsmodel->field('id,goodsname,shopprice,image,comment')->where($whereshow)->order('shopprice desc')->limit(3)->select();
            $this->assign('search',$doser['search']);
        }elseif(isset($doser['cateid'])){
            $get = I('get.');
            $where = array('category'=>$doser['cateid'],'cate'=>$doser['cateid'],'cate1'=>$doser['cateid'],'_logic'=>'or');
            $goods = $goodsmodel->field('id,goodsname,shopprice,image,comment')->where($where)->select();
            $cate1 = $catemodel->where(array('id'=>$doser['cateid']))->find();
            $catelist[1] = $cate1;
            $cate2 = $catemodel->where(array('id'=>$cate1['pid']))->find();
            if($cate2){
                $catelist[2] = $cate2;
                $cate3 = $catemodel->where(array('id'=>$cate2['pid']))->find();
                if($cate3){
                    $catelist[3] = $cate3;
                }
            }
            $catelist = array_reverse($catelist); 
            $whereshow['_complex'] = $where;
            $whereshow['commend'] = 2;
            $goodsshow = $goodsmodel->field('id,goodsname,shopprice,image,comment')->where($whereshow)->order('shopprice desc')->limit(3)->select();
            $this->assign('cate1',$cate1);
            $this->assign('catelist',$catelist);
        }
        foreach($goods as $k =>$v){
            $goods[$k]['image'] = '/Public'.ltrim(substr($v['image'],0,40),'.');
            if(mb_strlen($v['goodsname'],'utf8')>35){
                $goods[$k]['aname'] = mb_substr($v['goodsname'],0,35,'utf8').'…';
            }else{
                $goods[$k]['aname'] = $v['goodsname'];
            }
        }
        foreach($goodsshow as $k =>$v){
            $goodsshow[$k]['image'] = '/Public'.ltrim(substr($v['image'],0,40),'.');
            if(mb_strlen($v['goodsname'],'utf8')>35){
                $goodsshow[$k]['aname'] = mb_substr($v['goodsname'],0,35,'utf8').'…';
            }else{
                $goodsshow[$k]['aname'] = $v['goodsname'];
            }
        }
        $count = count($goods);    
        //dump($goods);die;
        $this->assign('goods',$goods);
        $this->assign('goodsshow',$goodsshow);
        $this->assign('count',$count);
        $this->display();
    }



}
