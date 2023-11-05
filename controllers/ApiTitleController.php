<?php
namespace App\Controllers;

class ApiTitleController extends \App\Core\ApiController {
    public function getTitleByCategoryId($categoryId) {
        $titleModel = new \App\Models\TitleModel($this->getDatabaseConnection());
        $titles = ($titleModel)->getAllByCategoryId($categoryId);

        if (!$titles) {
            $this->set('error', -20001);
            $this->set('message', 'In this category does not exist titles.');
            return;
        }

        $this->set('titles', $titles);
    }
    public function add() {
        // TODO: Ispraviti...
        $name = \filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $category = \filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);

        $titleModel = new \App\Models\TitleModel($this->getDatabaseConnection());
        $titleModel->add([
            'category_id' => intval($category),
            'title_name' => $name,
            'school_class' => 1
        ]);

        return "ok";
    }
}
