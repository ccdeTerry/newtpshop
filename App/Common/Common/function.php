<?php
/**
 * @myU 自定义U函数
 *
 * @param $name
 * @param $value
 *
 * @author : Terry
 * @return
 */
function myU($name,$value){
    if ($name=='sort'){
        $sort =$value;
        $price =I('get.price');
    }elseif($name='price'){
        $price=$value;
        $sort=I('get.sort');

    }
    return  U('category/index')."?id=".I('get.id')."&sort=".$sort.'&price='.$price;
}


