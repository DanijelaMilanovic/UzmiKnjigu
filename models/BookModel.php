<?php
namespace App\Models;

use App\Core\Model;
use App\Core\Field;
use App\Validators\NumberValidator;

class BookModel extends Model
{
    protected function getFields(): array
    {
        return [
            'book_id'           => new Field(new NumberValidator(), false),
            'author_id'         => new Field(new NumberValidator(), true),
            'publisher_id'      => new Field(new NumberValidator(), true),
            'title_id'          => new Field(new NumberValidator(), true),
            'user_id'           => new Field(new NumberValidator(), true),
            'state_id'          => new Field(new NumberValidator(), true),
            'status_id'         => new Field(new NumberValidator(), true),
            'price'             => new Field((new NumberValidator())->setDecimal()
                                                                    ->setUnsigned()
                                                                    ->setIntegerLength(10)
                                                                    ->setMaxDecimalDigits(2)),
            'publishing_year'   => new Field(new NumberValidator(), true),
            'pages'          => new Field(new NumberValidator(), true)

        ];
    }

    public function getAllByBookId(int $bookId): array
    {
        return $this->getAllByFieldName('book_id', $bookId);
    }

    public function getAllBySearch(string $keywords="", int $category=0, int $state=0, float $price=0.0) {
        $sql = 'SELECT `book`.* FROM `book` JOIN `title` ON (`book`.`title_id`=`title`.`title_id`) 
              WHERE 1';
        $data = array();

        if($keywords) {
            $keywords = '%' . $keywords . '%';
            $sql .= ' AND `title`.`title_name` LIKE ?';
            array_push($data, $keywords);
        }
        if($category) {
            $sql .= ' AND `title`.`category_id`=?';
            array_push($data, $category);
        }
        if($state) {
            $sql .= ' AND `book`.`state_id`=?';
            array_push($data, $state);
        }
        if($price) {
            $sql .= ' AND `book`.`price` < ?';
            array_push($data, $price);
        }
        $sql .= ';';

        //$keywords = '%' . $keywords . '%';

        $prep = $this->getConnection()->prepare($sql);
        if (!$prep) {
            return [];
        }

        $res = $prep->execute($data);
        if (!$res) {
            return [];
        }

        return $prep->fetchAll(\PDO::FETCH_OBJ);
    }
}