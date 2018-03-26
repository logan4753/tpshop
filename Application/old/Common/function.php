<?php

	function getTree($data,$pid=0,$space=0,$distant=''){
        $tree = array();
        foreach($data as $key => $val){
            if($val['pid'] == $pid){
                $val['space'] = $space+1;
                $val['distant'] = '└'.str_repeat('─', $space);
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