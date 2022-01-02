<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position_id',
        'head_id',
        'employment_at',
        'phone',
        'email',
        'salary',
        'photo',
        'admin_created_id',
        'admin_updated_id',
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class, 'head_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'head_id');
    }

    public function getEmploymentAtAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d.m.y');
    }

    public function getHead()
    {
        return $this->employee;
    }

    public function getSubordinates()
    {
        return $this->employees;
    }

    public function syncLevel()
    {
        return $this->getHead()
            ? $this->level = $this->getHead()->level + 1
            : $this->level = 1;
    }

    public function syncSubordinatesLevel()
    {
        if ($this->getHead()) {
            $this->level = $this->getHead()->level + 1;
        } else {
            $this->level = 1;
        }
        $this->saveQuietly();

        if ($this->getSubordinates()) {
            foreach ($this->getSubordinates() as $subordinate) {
                $subordinate->syncSubordinatesLevel();
            }
        }
    }
}
