<?php
/**
 * 链接数据库
 */
    class Connect{
        public $host = '';//主机
        public $user = '';//用户名
        public $password = '';//密码
        public $db = '';//数据库名
        public $connect = "";

        function __construct($host="localhost",$user="swhui",$password="huihenet",$db="swhui") {
            $this->host = $host;
            $this->user = $user;
            $this->password = $password;
            $this->db = $db;
            $this->Connection();
        }
        function  __destruct() {
            mysqli_close($this->connect);
        }
        /**
         * 创建数据库链接
         */
        private function Connection(){
            $connect = mysqli_connect($this->host, $this->user, $this->password, $this->db);
            mysqli_query($connect,"set names utf8");
            $this->connect = $connect;
        }
        /**
         *执行sql。无返回值
         * @param <type> $sql 
         */
        public function execute($sql){
            mysqli_query($this->connect,$sql);
        }
        /**
         *执行查询
         * @param <type> $sql
         * @return <array>
         */
        public function query_list($sql){
            $return = array();
            $result = mysqli_query($this->connect,$sql);
            while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                $return[] = $row;
            }
            mysqli_free_result($result);
            return $return;
        }
        public function query_row($sql){
            $return  = array();
            $result = mysqli_query($this->connect,$sql);
            while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                $return = $row;
            }
            mysqli_free_result($result);
            return $return;
        }
    }
?>