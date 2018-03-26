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

    function getPermission(){
        $roleid = session('back.userrole');
        $power = M('role')->field('power')->where(array('id'=>$roleid))->find();
        $permission = explode(',',$power['power']);
        if($roleid != 1){
            $where = array('status'=>1,'id'=>array('in',$permission));
        }else{
            $where = array();
        }
        $datas = M('permission')->where($where)->select();
        $aside = array();
        foreach($datas as $k => $v){
            if($v['pid'] == 0){
                array_push($aside,$v);
            }
        }
        foreach($datas as $key => $val){
            foreach($aside as $kk => $vv){
                if($val['pid'] == $vv['id']){
                    $val['perurl'] = U($val['peract']);
                    $val['per_act'] = str_replace('/','_',$val['peract']);
                    $aside[$kk]['child'][] = $val;
                }
            }
        }
        return $aside;
    }

    function getPage($count,$list){
        $page = new \Think\Page($count,$list);
        $page->setConfig('header', '<li class="rows">第<b>%NOW_PAGE%'.'/'.'%TOTAL_PAGE%</b>页</li>');
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('first', '首页');
        $page->setConfig('end', '尾页');
        $page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        return $page;
    }

