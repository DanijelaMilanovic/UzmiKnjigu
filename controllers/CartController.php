<?php
namespace App\Controllers;

use App\Core\Controller;

class CartController extends Controller {
    public function show() {
        $bookmarks = $this->getSession()->get('bookmarks', []);

        $titleModel = new \App\Models\TitleModel($this->getDatabaseConnection());
        $imageModel = new \App\Models\ImageModel($this->getDatabaseConnection());
        $stateModel = new \App\Models\StateModel($this->getDatabaseConnection());
        $authorModel = new \App\Models\AuthorModel($this->getDatabaseConnection());

        $books = [];
        $priceWithoutShipping = 0;
        foreach($bookmarks as $book) {
            $price = $book->price;
            $title  = ($titleModel)->getById($book->title_id);
            $titleName = ($title)->title_name;

            $images = ($imageModel)->getByFieldName('book_id',$book->book_id);
            $image = $images->image_url;

            $state = ($stateModel)->getById($book->state_id);
            $stateName = ($state)->state_name;

            $author = ($authorModel)->getById($book->author_id);
            $authorName = ($author)->first_name .' '. ($author)->last_name;

            $book = [
                "price"     => $price,
                "image"     => $image,
                "title"     => $titleName,
                "author"    => $authorName,
                "state"     => $stateName
            ];
            $priceWithoutShipping += $price;

            $books[] = array($book);
        }


        $this->set('books',$books);
        $this->set('priceWithoutShipping',$priceWithoutShipping);
        $this->set('priceWithShipping',$priceWithoutShipping+10);

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