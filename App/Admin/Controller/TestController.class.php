<?php
/**
 * Created by PhpStorm.
 * TestController.class.php
 * author: Terry
 * Date: 2017-9-25
 * Time: 19:21
 * description:
 */
namespace Admin\Controller;

class TestController{

    function  testTree($i =1){
        if ($i<10){
            $this->testTree($i++);
            echo $i.'<br/>';
        }

    }
}