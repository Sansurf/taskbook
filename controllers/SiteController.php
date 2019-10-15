<?php

namespace app\controllers;

use app\models\Users;
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
        $this->title .= "::Add new task";
        $this->breadcrumbs['Add'] = ['title' => 'Add', 'url' => '?action=add'];
        $message = '';

        if (!empty($_POST)) {
            $name = trim($_POST['userName']);
            $email = trim($_POST['email']);

            $title = trim($_POST['title']);
            $text = trim($_POST['text']);

            $db = DriverDB::getInstance();
            $userId = $db->insert('user', ['name' => $name, 'email' => $email]);
            $db->insert('task', ['user_id' => $userId, 'title' => $title, 'content' => $text]);

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
        $this->title .= "::Login";
        $this->breadcrumbs['Login'] = ['title' => 'Login', 'url' => '?action=login'];
        $model = Users::getInstance();
        $message = '';

        if (!empty($_POST)) {
            if ($model->Login($_POST['login'], $_POST['password'])) {
                header('Location: index.php?controller=admin');
            } else {
                $message = 'Incorrect username or password';
            }
        }

        return $this->render('site-login', ['message' => $message]);
    }
}
