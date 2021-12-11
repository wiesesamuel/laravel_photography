<?php

namespace App\Models;

use App\Enum\TaskState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function taskState() {
        return "Value";
        return TaskState::fromKey($this->getAttribute('taskStateKey'));
    }
    public function taskStateValue() {
        return "Value";
        return $this->taskState()->value;
    }

}
