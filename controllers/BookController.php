<?php
namespace App\Controllers;

use App\Core\Controller;

class BookController extends Controller {
    public function show(int $id) {
        $bookModel = new \App\Models\BookModel($this->getDatabaseConnection());
        $titleModel = new \App\Models\TitleModel($this->getDatabaseConnection());
        $imageModel = new \App\Models\ImageModel($this->getDatabaseConnection());
        $publisherModel = new \App\Models\PublisherModel($this->getDatabaseConnection());
        $authorModel = new \App\Models\AuthorModel($this->getDatabaseConnection());
        $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
        $stateModel = new \App\Models\StateModel($this->getDatabaseConnection());
        $statusModel = new \App\Models\StatusModel($this->getDatabaseConnection());

        $book = ($bookModel) ->getById($id);

        $price = $book->price;
        $title  = ($titleModel)->getById($book->title_id);
        $titleName = ($title)->title_name;
        $images = ($imageModel)->getAllByFieldName('book_id',$book->book_id);

        $imageURLS = [];
        foreach ($images as $image) {
            $imageURLS[] = $image->image_url;
        }
        $author = ($authorModel)->getById($book->author_id);
        $authorName = ($author)->first_name .' '. ($author)->last_name;

        $publisher = ($publisherModel)->getById($book->publisher_id);
        $publisherName = ($publisher)->name;

        $category = ($categoryModel)->getById($title->category_id);
        $categoryName = ($category)->category_name;

        $state = ($stateModel)->getById($book->state_id);
        $stateName = ($state)->state_name;

        $status = ($statusModel)->getById($book->status_id);
        $statusName = ($status)->status_name;

        $bookData = [
            "price"         => $price,
            "images"        => $imageURLS,
            "title"         => $titleName,
            "id"            => $book->book_id,
            "author"        => $authorName,
            "category"      => $categoryName,
            "publisher"     => $publisherName,
            "state"         => $stateName,
            "status"        => $statusName
        ];

        //var_dump($bookData);
        $this->set('book',$bookData);

        $userId = $this->getSession()->get('user_id');
        $userForename = $this->getSession()->get('user_forename');
        $userSurname = $this->getSession()->get('user_surname');
        $role = $this->getSession()->get('role');

        if ($userId !== null) {
            $this->set('userId', $userId);
            $this->set('userForename', $userForename);
            $this->set('userSurname', $userSurname);
            $this->set('role', $role);
        }

        if ($role == 1)
            $this->redirect(\Configuration::BASE . 'admin/');
    }

    private function normaliseKeywords(string $keywords): string {
        $keywords = trim($keywords);
        $keywords = preg_replace('/ +/', ' ', $keywords);
        # ...
        return $keywords;
    }

    public function postSearch() {
        $bookModel = new \App\Models\BookModel($this->getDatabaseConnection());
        $titleModel = new \App\Models\TitleModel($this->getDatabaseConnection());
        $imageModel = new \App\Models\ImageModel($this->getDatabaseConnection());
        $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());

        $q = filter_input(INPUT_POST, 'q', FILTER_SANITIZE_STRING);
        $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
        $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);

        $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING);

        $keywords = $this->normaliseKeywords($q);
        $books = $bookModel->getAllBySearch($keywords, intval($category), intval($state), floatval($price));

        foreach($books as $book) {
            if($book->status_id = 1) {
                $price = $book->price;
                $title = ($titleModel)->getById($book->title_id);
                $titleName = ($title)->title_name;
                $images = ($imageModel)->getByFieldName('book_id', $book->book_id);
                $image = "";
                if ($images) {
                    $image = $images->image_url;
                }

                $category = ($categoryModel)->getById($title->category_id);
                $categoryName = ($category)->category_name;

                $bookData = [
                    "id" => $book->book_id,
                    "price" => $price,
                    "image" => $image,
                    "title" => $titleName,
                    "category" => $categoryName
                ];

                $booksData[] = array($bookData);
            }
        }

        $this->set('books',$booksData);

        $userId = $this->getSession()->get('user_id');
        $userForename = $this->getSession()->get('user_forename');
        $userSurname = $this->getSession()->get('user_surname');
        $role = $this->getSession()->get('role');

        if ($userId !== null) {
            $this->set('userId', $userId);
            $this->set('userForename', $userForename);
            $this->set('userSurname', $userSurname);
            $this->set('role', $role);
        }

        if ($role == 1)
            $this->redirect(\Configuration::BASE . 'admin/');
    }
}