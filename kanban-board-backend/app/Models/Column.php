<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'column_index'
    ];

    public function cards(){
        return $this->hasMany(Card::class)->orderBy('card_index', 'ASC');
    }

    public function addCard(array $data)
    {
        $data['column_id'] = $this->id;
        $data['card_index'] = $this->cards->count();
        return Card::create($data);
    }
}
