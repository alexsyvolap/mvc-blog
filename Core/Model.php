<?php


namespace Core;

use PDO;
use App\Config;

abstract class Model
{

    /**
     * @return \Exception|PDO
     * Получаем коннект с базой
     */
    public static function getConnection()
    {
        try {
            $dsn = "mysql:host=".Config::DB_HOST.";dbname=".Config::DB_NAME.";charset=utf8";
            $opt = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ];
            return new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD, $opt);
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    /**
     * @param $sql
     * @param array $params
     * @return array|\Exception
     * Забираем с базы все строки
     */
    public static function getQuery($sql, array $params = [])
    {
        try {
            $pdo = self::getConnection();
            $exec = $pdo->prepare($sql);
            $exec->execute($params);
            $result = $exec->fetchAll();
            return $result;
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    /**
     * @param $sql
     * @param array $params
     * @return mixed
     * Забираем с базы только 1 строку
     */
    public static function getOneQuery($sql, array $params = [])
    {
        try {
            $pdo = self::getConnection();
            $exec = $pdo->prepare($sql);
            $exec->execute($params);
            $row = $exec->fetch();
            return $row;
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    /**
     * @param $sql
     * @param array $params
     * @return int|string
     * Забираем с базы последний добавленый пост
     */
    public static function setQuery($sql, array $params = [])
    {
        try {
            $pdo = self::getConnection();
            $exec = $pdo->prepare($sql);
            return $exec->execute($params) ? $pdo->lastInsertId() : 0;
        } catch (\Exception $exception) {
            return $exception;
        }
    }

}