<?php

namespace app\controllers;

use app\models\Users;
use app\models\DriverDB;
use voku\helper\Paginator;

class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $per_page = 3;      // количество выводимых записей на страницу

        $db = DriverDB::getInstance();
        $pages = new Paginator($per_page, 'page');

        if (isset($_GET['orderby'])) {      // сортировка по полю
            $query = $db->select("
                SELECT * FROM `user`,`task` 
                WHERE `task`.`user_id` = `user`.`id` 
                ORDER BY {$_GET['orderby']}"
                . $pages->get_limit()
            );
        } else {                            // без сортировки
            $query = $db->select("
                SELECT * FROM `user`,`task` 
                WHERE `task`.`user_id` = `user`.`id`"
                . $pages->get_limit()
            );
        }

        // подсчет общего количества записей в БД
        $totalItems = mysqli_num_rows($db->select("SELECT `id` FROM `task`"));
        $pages->set_total($totalItems);

        // массив с записями для вывода на страницу
        $data['records'] = $query;
        // пагинация
        $data['page_links'] = $pages->page_links('?' . http_build_query($_GET) . '&');

        return $this->render('site-index', ['data' => $data]);
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
                header('Location: admin-site-index.php?controller=Admin');
            } else {
                $message = 'Incorrect username or password';
            }
        }

        return $this->render('site-login', ['message' => $message]);
    }
}
