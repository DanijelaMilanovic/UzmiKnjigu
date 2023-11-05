<?php
namespace App\Models;

use App\Core\Model;
use App\Core\Field;
use App\Validators\NumberValidator;
use App\Validators\StringValidator;

class StatusModel extends Model
{
    protected function getFields(): array
    {
        return [
            'status_id'     =>new Field(new NumberValidator(), false),
            'status_name'   =>new Field(new StringValidator()),
        ];
    }

    public function getAllByStatusId(int $statusId): array
    {
        return $this->getAllByFieldName('status_id', $statusId);
    }
}