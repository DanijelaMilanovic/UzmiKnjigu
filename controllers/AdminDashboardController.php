<?php
namespace App\Controllers;

use App\Core\Role\UserRoleController;

class AdminDashboardController extends UserRoleController {
    public function index() {
        $userId = $this->getSession()->get('user_id');
        $userForename = $this->getSession()->get('user_forename');
        $userSurname = $this->getSession()->get('user_surname');

        if ($userId !== null) {
            $this->set('userId', $userId);
            $this->set('userForename', $userForename);
            $this->set('userSurname', $userSurname);
        }

        $titleModel = new \App\Models\TitleModel($this->getDatabaseConnection());
        $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
        $titles = $titleModel->getAll();

        $titlesData = [];
        foreach($titles as $title) {
            $category = $categoryModel->getById($title->category_id);

            $titleData = [
                "name"    => $title->title_name,
                "category" => $category->category_name
            ];
            $titlesData[] = array($titleData);
        }

        $categories = $categoryModel->getAll();

        $categoriesData = [];
        foreach ($categories as $category) {
            $categoryData = [
                "value" => $category->category_id,
                "name" => $category->category_name
            ];
            $categoriesData[] = array($categoryData);
        }
        $this->set('titles', $titlesData);
        $this->set('categories', $categoriesData);
    }
}