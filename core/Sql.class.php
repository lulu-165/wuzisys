<?php 
/**
 *数据库基类
 *
 * @author zhouhuixiang
 * @version 1.0
*/
class Sql
{
    protected $_dbHandle;
    protected $_result;
    //连接数据库
    // public function connect($host, $user, $pass, $dbname)
    // {
    //     try {
    //         $dsn = sprintf("mysql:host=%s;dbname=%s;charset=utf8", $host, $dbname);
    //         $this->_dbHandle = new PDO($dsn, $user, $pass, array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
    //     } catch (PDOException $e) {
    //         exit('错误: ' . $e->getMessage());
    //     }
    // }
    public function connect($host, $user, $pass, $dbname)
    {
        $this->_dbHandle = new mysqli($host, $user, $pass, $dbname);

        if ($this->_dbHandle->connect_errno) {
            exit("Unable to connect to the database");
        }

        $this->_dbHandle->set_charset("utf8");
    }

    //执行自定义的sql语句
    // function executeSQL($sql,$type="select"){
    	  
    //     $sth = $this->_dbHandle->prepare($sql);
    //     $res = $sth->execute();
 
    //     if($type=="select")return $sth->fetchAll(); //全部数据
    //     else if($type=="getRow")return $sth->rowCount(); //总行数     
    //     else return $res; //执行，并返回结果
    	
    // } 
    function executeSQL($sql,$type="select"){
        //var_dump($sql);
        $sth = $this->_dbHandle->prepare($sql);
        $res = $sth->execute();
        
        if($type=="select") {
            $res = $sth->get_result();
            $arr = [];
            while ($row = $res->fetch_array()) {
                $arr[] = $row;
            }
            //var_dump($arr);
            return $arr; //全部数据
        } else if ($type=="getRow") {
            return $sth->get_result()->num_rows; //总行数
        } else if ($type=="insert") {
            return $sth->insert_id; //返回插入ID
        } else if ($type=="delete") {
            return $sth->affected_rows;//返回删除的行数  0表示未删除    
        }else {
            return $res; //执行，并返回结果
        }
    	
    }
    function escapeHTML($str) {
        $str = str_replace("\\", "&#92;", $str);
        $str = str_replace('\'', "&#39;", $str);
        $str = str_replace("\"", "&quot;", $str);
        return $str;
    }

    function escape($q) {
        return $this->_dbHandle->escape_string($this->escapeHTML($q));
    }

    //查询所有
    public function selectAll()
    {
        $sql = sprintf("select * from `%s`", $this->_table);
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
 
        return $sth->fetchAll();
    }
    //根据条件 (id) 查询
    public function select($id)
    {
        $sql = sprintf("select * from `%s` where `id` = '%s'", $this->_table, $id);
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
        
        return $sth->fetch();
    }
    //根据条件 (id) 删除
    public function delete($id)
    {
        $sql = sprintf("delete from `%s` where `id` = '%s'", $this->_table, $id);
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
 
        return $sth->rowCount();
    }
    //自定义SQL查询，返回影响的行数
    public function query($sql)
    {
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
 
        return $sth->rowCount();
    }
    //新增数据
    public function add($data)
    {
        $sql = sprintf("insert into `%s` %s", $this->_table, $this->formatInsert($data));
 
        return $this->query($sql);
    }
    //修改数据
    public function update($id, $data)
    {
        $sql = sprintf("update `%s` set %s where `id` = '%s'", $this->_table, $this->formatUpdate($data), $id);
 
        return $this->query($sql);
    }
    //将数组转换成插入格式的sql语句
    private function formatInsert($data)
    {
        $fields = array();
        $values = array();
        foreach ($data as $key => $value) {
            $fields[] = sprintf("`%s`", $key);
            $values[] = sprintf("'%s'", $value);
        }
 
        $field = implode(',', $fields);
        $value = implode(',', $values);
 
        return sprintf("(%s) values (%s)", $field, $value);
    }
    //将数组转换成更新格式的sql语句
    private function formatUpdate($data)
    {
        $fields = array();
        foreach ($data as $key => $value) {
            $fields[] = sprintf("`%s` = '%s'", $key, $value);
        }
        return implode(',', $fields);
    }
}