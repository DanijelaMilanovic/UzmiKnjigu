<?php
namespace App\Controllers;

class ApiBookmarkController extends \App\Core\ApiController {
    public function getBookmarks() {
        $bookmarks = $this->getSession()->get('bookmarks', []);
        $this->set('bookmarks', $bookmarks);
    }

    public function addBookmark($bookId) {
        $bookModel = new \App\Models\BookModel($this->getDatabaseConnection());
        $book = $bookModel->getById($bookId);

        if (!$book) {
            $this->set('error', -1);
            return;
        }

        $bookmarks = $this->getSession()->get('bookmarks', []);

        foreach ($bookmarks as $bookmark) {
            if ($bookmark->book_id == $bookId) {
                $this->set('error', -2);
                return;
            }
        }

        $bookmarks[] = $book;
        $this->getSession()->put('bookmarks', $bookmarks);

        $this->set('error', 0);
    }

    public function clear() {
        $this->getSession()->put('bookmarks', []);

        $this->set('error', 0);
    }
}
