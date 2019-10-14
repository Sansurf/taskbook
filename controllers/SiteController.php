<?php

namespace app\controllers;

use app\models\DriverDB;

class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $vars = [];

        $db = DriverDB::getInstance();
        $query = $db->select("SELECT * FROM `user`,`task` WHERE `task`.`user_id` = `user`.`id`");

        foreach ($query as $key => $value) {
            $vars[$key] = $value;
        }

        return $this->render('site-index', $vars);
    }

    /**
     * Displays adding page.
     *
     * @return string
     */
    public function actionAdd()
    {
        $this->title .= "::Добавление новой задачи";
        $message = '';

        if (isset($_POST['userName']))
        {
            $name = trim($_POST['userName']);
            $email = trim($_POST['email']);

            $title = trim($_POST['title']);
            $text = trim($_POST['text']);

            $db = DriverDB::getInstance();
            $userId = $db->Insert('user', ['name' => $name, 'email' => $email]);
            $db->Insert('task', ['user_id' => $userId, 'title' => $title, 'content' => $text]);

            $message = "Task sent";
        }

        return $this->render('site-add', ['message' => $message]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        return $this->render('site-login', []);
    }
}
