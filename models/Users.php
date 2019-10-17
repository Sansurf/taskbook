<?php

namespace app\models;

/**
 * Менеджер пользователей
 */
class Users
{	
	private static $instance;	// экземпляр класса
	private $db;				// драйвер БД
	private $sid;				// идентификатор текущей сессии
	private $uid;				// идентификатор текущего пользователя

	private function __construct()
	{
		$this->db = DriverDB::getInstance();
		$this->sid = null;
		$this->uid = null;
	}

    /**
     * Получение экземпляра класса
     *
     * @return Users
     */
    public static function getInstance()
	{
		if (self::$instance == null)
			self::$instance = new Users();

		return self::$instance;
	}

	/**
     * Авторизация
     *
     * @param string $login
     * @param string $password
     * @return bool
     */
    public function Login($login, $password)
	{
		// вытаскиваем пользователя из БД 
		$user = $this->getByLogin($login);

		if ($user == false)
			return false;
		
		// проверяем пароль
		if ($user['password'] != md5($password))
			return false;
				
		return true;
	}

    /**
     * Получает пользователя по логину
     *
     * @param string $login
     * @return bool|mixed|string
     */
	public function getByLogin($login)
	{
		$sql = "SELECT * FROM `user` WHERE `name` = '%s'";
		$query = sprintf($sql, mysqli_real_escape_string($this->db->getLink(), $login));
		$result = $this->db->select($query);
        $row = mysqli_fetch_assoc($result);

		if (!$row) return false;

		return $row;
	}
}
