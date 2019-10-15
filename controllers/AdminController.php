<?php

namespace app\controllers;

use app\models\DriverDB;

class AdminController extends Controller
{
    public function actionIndex()
    {
        $this->title .= "::Admin page";
        $this->breadcrumbs['Admin'] = ['title' => 'Admin', 'url' => '?controller=admin'];

        $db = DriverDB::getInstance();
        $query = $db->select("SELECT * FROM `user`,`task` WHERE `task`.`user_id` = `user`.`id`");

        $vars = [];
        foreach ($query as $key => $value) {
            $vars[$key] = $value;
        }

        return $this->render('admin-index', $vars);
    }

    public function actionEdit()
    {
        $this->title .= "::Admin edit page";
        $this->breadcrumbs['Admin-edit'] = ['title' => 'Admin-edit', 'url' => '?controller=admin&action=edit'];

        $db = DriverDB::getInstance();
        $vars = [];

        // Получение задачи
        if (isset($_GET['id'])) {

            $this->title .= "::Edit task#" . $_GET['id'];

            $task = $db->select("SELECT * FROM `task` WHERE `id` = {$_GET['id']}");

            foreach ($task as $key => $value) {
                $vars[$key] = $value;
            }
        }

        if (isset($_POST['text'])) {

            $text = trim($_POST['text']);
            $sql = $db->update('task', ['content' => $text, 'status' => 1], "id={$_GET['id']}");

            if ($sql) header('Location: index.php?controller=admin');
        }

        $this->render('admin-edit', $vars);
    }
}