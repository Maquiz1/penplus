<?php
class OverideData{
    private $_pdo;
    function __construct(){
        try {
            $this->_pdo = new PDO('mysql:host='.config::get('mysql/host').';dbname='.config::get('mysql/db'),config::get('mysql/username'),config::get('mysql/password'));
        }catch (PDOException $e){
            $e->getMessage();
        }
    }

   public function unique($table,$field,$value){
        if($this->get($table,$field,$value)){
            return true;
        }else{
            return false;
        }
    }

    public function getNo($table){
        $query = $this->_pdo->query("SELECT * FROM $table");
        $num = $query->rowCount();
        return $num;
    }
    public function getCount($table,$field,$value){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $field = '$value'");
        $num = $query->rowCount();
        return $num;
    }

    public function getCount1($table, $field, $value, $field1, $value1)
    {
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $field = '$value' AND $field1 = '$value1'");
        $num = $query->rowCount();
        return $num;
    }

    public function countData($table,$field,$value,$field1,$value1){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $field = '$value' AND $field1 = '$value1'");
        $num = $query->rowCount();
        return $num;
    }

    public function countData1($table,$field,$value,$field1,$value1,$field2,$value2){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $field = '$value' AND $field1 = '$value1' AND $field2 = '$value2'");
        $num = $query->rowCount();
        return $num;
    }

    public function countData2($table, $field, $value, $field1, $value1, $field2, $value2)
    {
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $field = '$value' AND $field1 = '$value1' AND $field2 = '$value2'");
        $num = $query->rowCount();
        return $num;
    }

    public function getData($table){
        $query = $this->_pdo->query("SELECT * FROM $table");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getData2($table,$field,$value){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $field = '$value'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getNews($table,$where,$id,$where2,$id2){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $where = '$id' AND $where2 = '$id2'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function get2($table,$where,$id,$where2,$id2){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $where = '$id' AND $where2 = '$id2'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function get3($table,$where,$id,$where2,$id2,$where3,$id3){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $where = '$id' AND $where2 = '$id2' AND $where3 = '$id3'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function get4($table,$where,$id,$where2){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $where = '$id' AND $where2 >= 20");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function get5($table, $where, $id, $id2, $where2)
    {
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $where = '$id' AND $id2 >= '$where2'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getSumD($table,$variable){
        $query = $this->_pdo->query("SELECT SUM($variable) FROM $table");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getSumD1($table,$variable, $field, $value){
        $query = $this->_pdo->query("SELECT SUM($variable) FROM $table WHERE $field = '$value' ");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function get($table,$where,$id){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $where = '$id'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getArray($table, $where, $id)
    {
        $query = $this->_pdo->query("SELECT 'cardiac' FROM $table WHERE $where = '$id'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getRQ1($table){
        $query = $this->_pdo->query("SELECT * FROM $table");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function get_new($table,$where,$id,$where1,$type){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $where = '$id' AND $where1 = '$type'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function searchBtnDate2($table,$var,$value,$var1,$value1){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $var >= '$value' AND $var1 <= '$value1'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function delete($table,$field,$value){
        return $this->_pdo->query("DELETE FROM $table WHERE $field = $value");
    }

    public function lastRow($table,$value){
        $query = $this->_pdo->query("SELECT * FROM $table ORDER BY $value DESC LIMIT 1");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getlastRow($table,$where,$value,$id){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE  $where='$value' ORDER BY $id DESC LIMIT 1");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getlastRow1($table,$where,$value,$where1,$value1,$id){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE  $where='$value' AND $where1='$value1' ORDER BY $id DESC LIMIT 1");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getWithLimit3($table, $where, $id, $where2, $id2, $where3, $id3, $page, $numRec)
    {
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $where = '$id' AND $where2 = '$id2' AND $where3 = '$id3' limit $page,$numRec");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getWithLimit2($table,$field,$value,$field1,$value1,$value2,$field2,$page,$numRec){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $field = '$value' AND $field1 = '$value1' AND $value2 = '$field2' limit $page,$numRec");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getWithLimit1($table,$where,$id,$where2,$id2,$page,$numRec){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $where = '$id' AND $where2 = '$id2' limit $page,$numRec");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getWithLimit($table,$where,$id,$page,$numRec){
        $query = $this->_pdo->query("SELECT * FROM $table WHERE $where = '$id' limit $page,$numRec");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getDataLimit($table, $page, $numRec)
    {
        $query = $this->_pdo->query("SELECT * FROM $table WHERE 1 limit $page,$numRec");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    function tableHeader($table){
        $query = $this->_pdo->query("DESCRIBE $table");
        $result = $query->fetchAll(PDO::FETCH_COLUMN);
        return $result;
    }

    public function firstRow($table,$param,$id,$where,$client_id){
        $query = $this->_pdo->query("SELECT DISTINCT $param FROM $table WHERE $where = '$client_id' ORDER BY '$id' ASC");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function firstRow1($table, $param, $id, $where, $client_id,$where1,$id1)
    {
        $query = $this->_pdo->query("SELECT DISTINCT $param FROM $table WHERE $where = '$client_id' AND $where1 = '$id1' ORDER BY '$id' ASC");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function clearDataTable($table){
        $query = $this->_pdo->query("TRUNCATE TABLE `$table`");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // public function clearDataTable($table)
    // {
    //     $query = $this->_pdo->query("TRUNCATE TABLE `$table`");
    //     $result = $query->fetchAll(PDO::FETCH_ASSOC);
    //     return $result;
    // }

    public function AllTables()
    {
        $query = $this->_pdo->query("SHOW TABLES");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    public function AllTablesCont()
    {
        $query = $this->_pdo->query("SHOW TABLES");
        $num = $query->rowCount();
        return $num;
    }

    public function AllDatabasesCount()
    {
        $query = $this->_pdo->query("SHOW DATABASES");
        $num = $query->rowCount();
        return $num;
    }

    public function AllDatabases()
    {
        $query = $this->_pdo->query("SHOW DATABASES");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}