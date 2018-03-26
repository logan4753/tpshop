<?php
namespace Admin\Controller;
use Think\Controller;
header("content-type:text/html;charset=utf-8");
class IndexController extends Controller {

    public function index(){
        $this->display();  	
    }

    public function permission(){
        $Model = D('permission');
        $data = $Model->select();
        $data = getTree($data);
        //dump($data);die;
        $this->assign('data',$data);
        $this->display();
    }

    public function permissionAdd(){
        $Model = D('permission');
        $data = $Model->field('id,pername,pid')->select();
        $data = getTree($data);
        //dump($data);die;
        $this->assign('data',$data);
        $this->display();
    }

    public function permissionSave(){
        $params = I('post.');
        //dump($params);die;
        $id = I('id',0);
        $Model = D('permission');
        $result = $Model->create();
        if($result){
            if(empty($id)){
                $Model->add();
            }else{
                $Model->save();
            }
            $this->ajaxReturn(array('status'=>1,'info'=>'操作成功'));
        }else{
            $this->error($Model->getError());
        }
        /*if(!isset($params['pid'])){
            $this->error('请选择上级权限');
        }
        if(!isset($params['pername'])){
            $this->error('请输入权限名称');
        }
        $Model = D('permission');
        $data['pid'] = $params['pid'];
        $data['pername'] = $params['pername'];
        $data['peract'] = $params['peract'];
        $data['status'] = $params['status'];
        if($Model->create($data)){
            //dump($Model->create($data));die;
            $ret = $Model->add();
        }
        if($ret){
            $this->success('添加成功');
        }*/
    }

    public function permissionEdit(){
        $id = I('id',0);
        if(empty($id)){
            $this->error('参数错误');
        }
        $Model = D('permission');
        $list = $Model->where(array('id'=>$id))->find();//dump($data);die;
        $data = $Model->field('id,pername')->select();
        $this->assign('list',$list);
        $this->assign('data',$data);
        $this->display('permissionAdd');
    }




}