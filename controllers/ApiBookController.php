<?php

namespace App\Controllers;

class ApiBookController extends \App\Core\ApiController
{
    public function getBooksByPageNumber($pageNumber)
    {
        $bookModel = new \App\Models\BookModel($this->getDatabaseConnection());
        $titleModel = new \App\Models\TitleModel($this->getDatabaseConnection());
        $imageModel = new \App\Models\ImageModel($this->getDatabaseConnection());
        $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());

        $books = ($bookModel) ->getCertainRows(10,($pageNumber-1)*10);

        foreach($books as $book) {
            $price = $book->price;
            $title  = ($titleModel)->getById($book->title_id);
            $titleName = ($title)->title_name;
            $images = ($imageModel)->getByFieldName('book_id',$book->book_id);
            $image = $images->image_url;

            $category = ($categoryModel)->getById($title->category_id);
            $categoryName = ($category)->category_name;

            $bookApi = [
                "id"        => $book->book_id,
                "price"     => $price,
                "image"     => $image,
                "title"     => $titleName,
                "category"  => $categoryName
            ];

            $booksApi[] = array($bookApi);
        }

        $this->set('books',$booksApi);
    }
}
