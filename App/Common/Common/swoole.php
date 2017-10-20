<?php
/*
 * Created by PhpStorm.
 * Author: Terry
 * Date: 2017/10/17
 * Time: 13:27
 * description:

if (php_sapi_name() !== 'cli') {
    exit("使用cli模式");
}
$ws = new swoole_websocket_server("192.168.101.101", 6688);
// 设置配置
$ws->set(
    array(
        'daemonize' => false,      // 是否是守护进程
        'max_request' => 10000,    // 最大连接数量
        'dispatch_mode' => 2,
        'debug_mode'=> 1,
        // 心跳检测的设置，自动踢掉掉线的fd
        'heartbeat_check_interval' => 5,
        'heartbeat_idle_time' => 600,
    )
);

//监听WebSocket连接打开事件
$ws->on('open', function ($ws, $request) {
    $ws->push($request->fd, "您好,京西商城客服Terry,有什么可以帮您?\n");
});

//监听WebSocket消息事件，其他：swoole提供了bind方法，支持uid和fd绑定
$ws->on('message', function ($ws, $frame) {
    $msg = 'from'.$frame->fd.":{$frame->data}\n";

    // 分批次发送
    $start_fd = 0;
    while(true)
    {
        // connection_list函数获取现在连接中的fd
        $conn_list = $ws->connection_list($start_fd, 100);   // 获取从fd之后一百个进行发送
        var_dump($conn_list);
        echo count($conn_list);

        if($conn_list === false || count($conn_list) === 0)
        {
            echo "finish\n";
            return;
        }

        $start_fd = end($conn_list);

        foreach($conn_list as $fd)
        {
            $ws->push($fd, $msg);
        }
    }
});

//监听WebSocket连接关闭事件
$ws->on('close', function ($ws, $fd) {
    echo "client-{$fd} is closed\n";
    $ws->close($fd);   // 销毁fd链接信息
});

$ws->start();*/

class Server
{
    private $serv;

    public function __construct() {
        $this->serv = new swoole_server("192.168.101.101", 6688);
        $this->serv->set(array(
            'worker_num' => 8,
            'daemonize' => false,
            'max_request' => 10000,
            'dispatch_mode' => 2,
            'debug_mode'=> 1,
            'task_worker_num'=>8
        ));
        //注册回调函数
        $this->serv->on('Start', array($this, 'onStart'));
        $this->serv->on('Connect', array($this, 'onConnect'));
        $this->serv->on('Receive', array($this, 'onReceive'));
        $this->serv->on('Close', array($this, 'onClose'));
        $this->serv->on('Task', array($this, 'onTask'));
        $this->serv->on('Finish', array($this, 'onFinish'));
        $this->serv->start();
    }
    //onStart回调在server运行前被调用
    public function onStart( $serv ) {
        echo "Start\n";
    }
    //onConnect在有新客户端连接过来时被调用,onConnect处监听新的连接
    public function onConnect( $serv, $fd, $from_id ) {
        $serv->send( $fd, "Hello {$fd}!" );
    }
    //onReceive函数在有数据发送到server时被调用,onReceive处接收数据并处理
    public function onReceive( swoole_server $serv, $fd, $from_id, $data ) {
        echo "Get Message From Client {$fd}:{$data}\n";
        $param = array(
            'fd' => $fd
        );
        // start a task
        $serv->task( json_encode( $param ) );
    }
    //onClose在有客户端断开连接时被调用,onClose处处理客户端下线的事件
    public function onClose( $serv, $fd, $from_id ) {
        echo "Client {$fd} close connection\n";
    }

    public function onTask($serv,$task_id,$from_id, $data) {
        echo "This Task {$task_id} from Worker {$from_id}\n";
        echo "Data: {$data}\n";
        for($i = 0 ; $i < 10 ; $i ++ ) {
            sleep(1);
            echo "Task {$task_id} Handle {$i} times...\n";
        }
        $fd = json_decode( $data , true )['fd'];
        $serv->send( $fd , "Data in Task {$task_id}");
        return "Task {$task_id}'s result";
    }
    //接收到Task任务的处理结果$data
    public function onFinish($serv,$task_id, $data) {
        echo "Task {$task_id} finish\n";
        echo "Result: {$data}\n";
    }
}
// 启动服务器
$server = new Server();



