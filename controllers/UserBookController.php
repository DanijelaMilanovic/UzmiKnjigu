<?php
namespace App\Controllers;

use App\Core\Role\UserRoleController;
use App\Models\AuthorModel;
use App\Models\CategoryModel;
use App\Models\PublisherModel;
use App\Models\StateModel;
use App\Models\StatusModel;
use App\Models\TitleModel;
use Gumlet\ImageResizeException;

class UserBookController extends UserRoleController {

    public function getAddBook() {
        $userId = $this->getSession()->get('user_id');
        $userForename = $this->getSession()->get('user_forename');
        $userSurname = $this->getSession()->get('user_surname');

        if ($userId !== null) {
            $this->set('userId', $userId);
            $this->set('userForename', $userForename);
            $this->set('userSurname', $userSurname);
        }

        $categories = (new CategoryModel($this->getDatabaseConnection()))->getAll();
        $this->set('categories', $categories);

        $publishers = (new PublisherModel($this->getDatabaseConnection()))->getAll();
        $this->set('publishers', $publishers);

        $authors = (new AuthorModel($this->getDatabaseConnection()))->getAll();
        $this->set('authors', $authors);

        $states = (new StateModel($this->getDatabaseConnection()))->getAll();
        $this->set('states', $states);
    }
    //TODO: Insert security measures
    public function postAddBook() {
        $addData = [
            'author_id'          => \filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING),
            'publisher_id'    => \filter_input(INPUT_POST, 'publisher', FILTER_SANITIZE_STRING),
            'title_id'      => \filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING),
            'state_id'        => \filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING),
            'status_id'    => 1,
            'price' => sprintf("%.2f", \filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING)),
            'publishing_year'   => \filter_input(INPUT_POST, 'publishing_year', FILTER_SANITIZE_STRING),
            'pages' => \filter_input(INPUT_POST, 'pages', FILTER_SANITIZE_STRING),
            'user_id'        => $this->getSession()->get('user_id')
        ];

        if ($addData['author_id'] == NULL or $addData['publisher_id'] == NULL or $addData['title_id'] == -1
            or $addData['state_id'] == NULL or $addData['price'] == "0.00" or $addData['publishing_year'] == "" or $addData['pages'] == "") {
            $this->set('message', 'Forma nije korektno popunjena!');
            $this->getAddBook();
            return;
        }

        $bookModel = new \App\Models\BookModel($this->getDatabaseConnection());

        $bookId = $bookModel->add($addData);

        if (!$bookId) {
            $this->set('message', 'Knjiga nije uspješno dodata.');
            $this->getAddBook();
            return;
        }

        /*
        $uploadStatus = $this->doImageUpload($bookId);
        if (!$uploadStatus) {
            return;
        }*/
        $countfiles = count($_FILES['pictures']['name']);

        if (empty($_FILES['pictures']['name'][0])) {
            $this->set('message', 'Slika knjige je obavezna!');
            $this->getAddBook();
            return;
        }

        // Looping all files
        for($i=0;$i<$countfiles;$i++){
            $filename = $_FILES['pictures']['name'][$i];

            // Upload file
            move_uploaded_file($_FILES['pictures']['tmp_name'][$i], \Configuration::UPLOAD_DIR . $bookId. '_' . $filename);
            (new \App\Models\ImageModel($this->getDatabaseConnection()))->add([
                'book_id' => $bookId,
                'image_url' => $bookId. '_' . $filename
            ]);
            /*
            $this->doResize(
                \Configuration::UPLOAD_DIR . $bookId. '_' . $filename,
                \Configuration::DEFAULT_IMAGE_WIDTH,
                \Configuration::DEFAULT_IMAGE_HEIGHT);
            */
        }

        $this->redirect( \Configuration::BASE);
    }
/*
    private function doImageUpload(string $bookId): bool {
        $bookModel = new \App\Models\BookModel($this->getDatabaseConnection());
        $book = $bookModel->getById(intval($bookId));
        # codeguy/upload

        $uploadPath = new \Upload\Storage\FileSystem(\Configuration::UPLOAD_DIR);
        $files = new \Upload\File('pictures[]', $uploadPath);
        foreach ($files as $file) {
            $file->setName($bookId.$file->getName());
            $file->addValidations([
                new \Upload\Validation\Mimetype(["image/*"]),
                new \Upload\Validation\Size("3M")
            ]);

            try {
                $file->upload();

                $fullFilename = $file->getNameWithExtension();

                (new \App\Models\ImageModel($this->getDatabaseConnection()))->add([
                    'book_id' => $bookId,
                    'image_url' => $fullFilename
                ]);

                $this->doResize(
                    \Configuration::UPLOAD_DIR . $fullFilename,
                    \Configuration::DEFAULT_IMAGE_WIDTH,
                    \Configuration::DEFAULT_IMAGE_HEIGHT);

            } catch (\Exception $e) {
                $this->set('message', 'Greska: ' . implode(', ', $file->getErrors()));
                return false;
            }
            return true;

        }
    }
*/
    /**
     * @throws ImageResizeException
     */
    /*
    private function doResize(string $filePath, int $w, int $h) {
        $longer = max($w, $h);

        $image = new \Gumlet\ImageResize($filePath);
        $image->resizeToBestFit($longer, $longer);
        $image->crop($w, $h);
        $image->save($filePath);
    }*/
}
