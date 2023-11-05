<?php
namespace App\Models;

use App\Core\Model;
use App\Core\Field;
use App\Validators\NumberValidator;
use App\Validators\StringValidator;

class AuthorModel extends Model{
    protected function getFields(): array {
        return [
            'author_id'     => new Field(new NumberValidator(), false),
            'first_name'    => new Field(new StringValidator()),
            'last_name'     => new Field(new StringValidator()),

        ];
    }
    public function getByAuthorId(int $authorId) {
        return $this->getByFieldName('author_id',$authorId);
    }
}
