<?php
/**
 * Created by PhpStorm.
 * User: wenwu
 * Date: 2018/9/9
 * Time: 14:46
 */
namespace app\index\controller;
use think\Controller;
use think\facade\Config;

class Index extends Controller {
    public function index(){
        return $this->fetch();
    }
}