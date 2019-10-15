<?php

namespace app\models;

require "../config/db.php";

/**
 * Модель для взаимодействий с базой данных.
 * Модель обеспечивает единственное подключение к БД в момент времени
 */
class DriverDB
{
    private $link;
    private static $instance;

    private function __construct()
    {
        $this->link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
            or die(mysqli_error($this->link));
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new DriverDB();
        }

        return self::$instance;
    }

    /**
     * Возвращает идентификатор соединения с БД (необходим для модели Users)
     *
     * @return false|\mysqli
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Запрос на выборку данных из БД
     *
     * @param string $sql
     * @return array|string[]|null
     */
    public function select($sql)
    {
        $result = mysqli_query($this->link, $sql);
        if (!$result) die(mysqli_error($this->link));

        $rows = [];
        $count = mysqli_num_rows($result);
        for ($i = 0; $i < $count; $i++) {
            $rows[] = mysqli_fetch_assoc($result);
        }

        return $rows;
    }

    /**
     * Вставка в БД
     *
     * @param string $table
     * @param array $params Массив значений для вставки в БД в виде 'поле'=>'значение'
     * @return int|string
     */
    public function insert($table, $params)
    {
        $columns = [];
        $values = [];
        foreach ($params as $key => $value) {
            $columns[] = mysqli_real_escape_string($this->link, $key);
            if ($value == null) {
                $values[] = NULL;
            } else {
                $value = mysqli_real_escape_string($this->link, $value);
                $values[] = "'$value'";
            }
        }
        $columnsStr = implode(',', $columns);
        $valuesStr = implode(',', $values);

        $sql = "INSERT INTO $table ($columnsStr) VALUES ($valuesStr);";
        $result = mysqli_query($this->link, $sql);
        if (!$result) die(mysqli_error($this->link));

        return mysqli_insert_id($this->link);
    }

    /**
     * Обновление записи в БД
     *
     * @param string $table
     * @param array $params Массив значений для вставки в БД в виде ['поле'=>'значение', ...]
     * @param string $where
     * @return int
     */
    public function update($table, $params, $where)
    {
        $set = [];
        foreach ($params as $key => $value) {
            $key = mysqli_real_escape_string($this->link, $key);
            if ($value == null) {
                $set[] = "$key = NULL";
            } else {
                $value = mysqli_real_escape_string($this->link, $value);
                $set[] = "$key = '$value'";
            }
        }
        $setStr = implode(',', $set);
        $sql = sprintf("UPDATE %s SET %s WHERE %s", $table, $setStr, $where);
        $result = mysqli_query($this->link, $sql);

        if (!$result) die(mysqli_error($this->link));

        return mysqli_affected_rows($this->link);
    }
}