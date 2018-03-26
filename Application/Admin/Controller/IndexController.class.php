<?php
namespace Admin\Controller;
use Think\Controller;

class IndexController extends Controller {

    public function index(){
    	if(!session('back.userid')){
            $this->error('请登录',U('admin/login'));
        }
        $model = M('backuser');
        $list = S('list');
        if(!$list){
            $list = $model->where(array('id'=>session('back.userid')))->find();
            $list['tname'] = $_SERVER['SERVER_NAME'];
            $list['port'] = $_SERVER['SERVER_PORT'];
            $list['addr'] = $_SERVER['SERVER_ADDR'];
            $list['sid'] = session_id();
            $list['getu'] = Get_Current_User();
            S('list',$list);
        }
        //dump($list);die;
		$this->assign('list',$list);
        $this->display();  	
    }

    /*public function test(){
        $class = new \Think\Cache\Driver\Memcache();  
        $class->set('key','1234');  
        $data = $class->get('key');  
        echo $data; 
    }*/

    /*public function test1(){
        $value = 'qwwsa';
        S('test',$value,array('type'=>'memcache','host'=>'127.0.0.1','port'=>'11211','prefix'=>'think','expire'=>60));
        $test = S('test');
        if(!$test){
             $test = '缓存信息';
             S('test',$test,300);
             echo $test.'-来自数据库';
        }else{
             echo $test.'-来自memcached';
        }
    }*/

    /*public function test2(){
        S(array(
            'type'=>'memcache',
            'host'=>'127.0.0.1',
            'port'=>'11211',
            'prefix'=>'think',
            'expire'=>120)
        );
        S('a','axsxa');
        $val = S('a');
        dump($val);
    }*/

    /*public function test3(){
        // 初始化缓存
        $cache = S(array(
            'type'=>'memcache',
            'host'=>'127.0.0.1',
            'port'=>'11211',
            'prefix'=>'think',
            'expire'=>120)
        );
        $cache->name = 'value'; 
        // 设置缓存
        $value = $cache->name;
        dump($value); 
        // 获取缓存
        //unset($cache->name);
        // 删除缓存
    }
*/


}