<?php
namespace App\Models;

use App\Core\Model;
use App\Core\Field;
use App\Validators\NumberValidator;
use App\Validators\StringValidator;

class PublisherModel extends Model
{
    protected function getFields(): array
    {
        return [
            'publisher_id'  =>new Field(new NumberValidator(), false),
            'name'          =>new Field(new StringValidator()),
            'residence'     =>new Field(new StringValidator())
        ];
    }

    public function getAllByPublisherId(int $publisherId): array
    {
        return $this->getAllByFieldName('publisher_id', $publisherId);
    }
}