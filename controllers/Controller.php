<?php

namespace app\controllers;

/**
 * Controller is the base class of web controllers.
 */
class Controller
{
    // метатеги
    public $title = "Задачник";
    public $description;

    /**
     * Контент для вставки в базовый шаблон
     *
     * @param string $view  Путь до файла
     * @param array $params Передаваемые параметры
     * @return bool
     */
    public function render($view, $params = [])
    {
        $content = $this->template($view, $params);
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
        $vars = array('title' => $this->title, 'description' => $this->description, 'content'=>$content);
        if ($output = $this->template('../views/layout/main.php', $vars)) {
            echo $output;
            return true;
        }
        return false;
    }

    /**
     * Генератор HTML
     *
     * @param $fileName
     * @param array $vars
     * @return string
     */
    protected function template($fileName, $vars = [])
    {
        // Установка переменных для шаблона.
        foreach ($vars as $k => $v)
        {
            $$k = $v;
        }

        // Генерация HTML в строку.
        ob_start();
        include "$fileName";
        return ob_get_clean();
    }
}