<?php
/**
 * Created by PhpStorm.
 * OrderModel.class.php
 * author: Terry
 * Date: 2017-10-13
 * Time: 7:13
 * description:
 */
namespace Admin\Model;

class OrderModel extends CommonModel{
    /**
     * @getOrderList 获取订单列表
     * @author : Terry
     * @return
     */
    public function getOrderList(){
        $p=I('get.p');
        return $this->CommonListData($p);
    }

    /**
     * @getOrderDetail 获取订单详情
     * @author : Terry
     * @return
     */
    public function getOrderDetail($order_id){
       return $this->alias('o')->field('o.*,u.username')->join('left join __USER__ as u on o.user_id =u.id ')->where(['o.id'=>$order_id])->find();
    }


    /**
     * @export_execl 数据导出类
     *
     * @param $data
     *
     * @author : Terry
     * @return
     */
    private function PHPexecl($data){

        //设置php运行时间
        set_time_limit(0);
        /**
         * 大数据导出①
         * 设置php可使用内存
         * ini_set("memory_limit", "1024M");
         */

        Vendor('PHPExcel.PHPExcel');
        Vendor('PHPExcel.PHPExcel.Writer.Excel2007');
        $objExcel  = new \PHPExcel();
        $objWriter = new \PHPExcel_Writer_Excel2007($objExcel);
        $objProps  = $objExcel->getProperties();
        $objProps->setCreator("tpshop");
        $objProps->setTitle("tpshop用户表");
        $objExcel->setActiveSheetIndex(0);
        $objActSheet = $objExcel->getActiveSheet();
        $objActSheet->getColumnDimension('A')->setWidth(20);
        $objActSheet->getColumnDimension('B')->setWidth(20);
        $objActSheet->getColumnDimension('C')->setWidth(20);
        $objActSheet->getColumnDimension('D')->setWidth(20);
        $objActSheet->setCellValue('A1', '订单id');
        $objActSheet->setCellValue('B1', '订单号');
        $objActSheet->setCellValue('C1', '邮箱');
        $objActSheet->setCellValue('D1', '性别');
        $objActSheet->setCellValue('E1', '性别');
        $objActSheet->setCellValue('D1', '性别');
        $objActSheet->setCellValue('D1', '性别');
        $objActSheet->setCellValue('D1', '性别');
        $objActSheet->setCellValue('D1', '性别');
        $objActSheet->setCellValue('D1', '性别');
        foreach ($data as $key => $value) {
            $i = $key + 2;
            $objActSheet->setCellValue('A' . $i, $value['user_id']);
            $objActSheet->setCellValue('B' . $i, $value['username']);
            $objActSheet->setCellValue('C' . $i, $value['user_email']);
            $objActSheet->setCellValue('D' . $i, $value['user_sex'] == '1' ? '男' : '女');
            $objActSheet->setCellValue('E' . $i, $value['user_qq']);
            $objActSheet->setCellValue('F' . $i, $value['user_tel']);
        }
        //保存到服务器
        $dir = './Public/upload/execl/';
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        $fileName = $dir . date("Y-m", time()) . '_tpshop用户表.xlsx';
        $objWriter->save($fileName);

        //保存到本地
//        $fileName = date("Y-m-d", time()) . '_tpshop用户表.xlsx';
//        header('Content-Type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//        //设置文件名
//        header('Content-Disposition:attachment;filename="'.$fileName.'"');
//        //禁止缓存
//        header('Cache-Control:max-age=0');
//        $objWriter->save("php://output");

    }
}