<?php

namespace app\controllers;


class AdminController extends Controller
{
    public function actionIndex()
    {
        return $this->render('admin-index', []);
    }
}