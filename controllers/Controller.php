<?php

namespace app\controllers;

/**
 * Controller is the base class of web controllers.
 */
class Controller
{
    // метатеги
    public $title = "Taskbook";
    public $description;
    public $breadcrumbs = ['Home' => ['title' => 'Home', 'url' => '/']];

    /**
     * Контент для вставки в базовый шаблон
     *
     * @param string $view Название файла
     * @param array $vars Переменные для шаблона
     * @return bool
     */
    public function render($view, $vars = [])
    {
        $content = $this->template("../views/$view.php", $vars);
        if ($this->renderLayout($content)) return true;

        return false;
    }

    /**
     * Базовый шаблон
     *
     * @param string $content Контент для вставки
     * @return bool
     */
    private function renderLayout($content)
    {
        $vars = array(
            'title' => $this->title,
            'description' => $this->description,
            'breadcrumbs' => $this->breadcrumbs,
            'content' => $content
        );

        if ($output = $this->template('../views/layout/main.php', $vars)) {
            echo $output;
            return true;
        }

        return false;
    }

    /**
     * Генератор HTML
     *
     * @param $view
     * @param array $vars
     * @return string
     */
    protected function template($view, $vars = [])
    {
        // Установка переменных для шаблона.
        foreach ($vars as $k => $v) {
            $$k = $v;
        }

        // Генерация HTML в строку.
        ob_start();
        include "$view";
        return ob_get_clean();
    }
}