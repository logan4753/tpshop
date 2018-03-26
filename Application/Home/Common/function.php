<?php

	function getTree($data,$pid=0,$space=0,$distant=''){
        $tree = array();
        foreach($data as $key => $val){
            if($val['pid'] == $pid){
                $val['space'] = $space+1;
                $val['distant'] = str_repeat('─', $space);
                array_push($tree,$val);
                $tree = array_merge($tree,getTree($data,$val['id'],$val['space']));
            }          
        }
        return $tree;
    }

    function getTree2($data,$pid=0){
        $tree = array();
        foreach($data as $k => $v){
            if($v['pid'] == $pid){
                $v['children'] = getTree2($data,$v['id']);
                $tree[] = $v;
            }
        }
        return $tree;
    }

    function getsalt(){
        $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
        return $salt;
    }

    function generateHash($password,$salt) {
        if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
            return crypt($password, $salt);
        }
    }

    function getcates(){
        $catemodel = M('category');
        $datacart = S('datacart');
        if(!$datacart){
            $data = $catemodel->where(array('status'=>1))->select();
            $datacart = getTree2($data);
            S('datacart',$datacart); 
        }
        return $datacart;
    }

    function getcart($where=''){
        $cartmodel = M('cartitem');
        $goodsmodel = M('goods');
        $wherearr = array('userid'=>session('front.userid'),'isorder'=>1);
        if($where){
            foreach($where as $k => $v){
                $wherearr[$k] = $v;
            }
        }
        $goodslist = $cartmodel->where($wherearr)->select();
        $goodscount = $pricesum = 0;
        foreach($goodslist as $key => $val){
            $goodslist[$key]['goodsname'] = $goodsmodel->where(array('id'=>$val['goodsid']))->getField('goodsname');
            if(mb_strlen($goodslist[$key]['goodsname'],'utf8')>50){
                $goodslist[$key]['aname'] = substr($goodslist[$key]['goodsname'],0,40).'…';
            }else{
                $goodslist[$key]['aname'] = $goodslist[$key]['goodsname'];
            }                   
            $goodslist[$key]['shopprice'] = $goodsmodel->where(array('id'=>$val['goodsid']))->getField('shopprice');
            $image = $goodsmodel->where(array('id'=>$val['goodsid']))->getField('image');
            $goodslist[$key]['image'] = '/Public'.ltrim(substr($image,0,40),'.');
            $goodscount += $val['gcount'];
            $pricesum += $goodslist[$key]['gcount']*$goodslist[$key]['shopprice'];
        }
        $cart = array('goodslist'=>$goodslist,'goodscount'=>$goodscount,'pricesum'=>$pricesum);       
        return $cart; 
    }


