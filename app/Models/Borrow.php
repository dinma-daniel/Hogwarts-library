<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Borrow extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'book_id', 'borrow_date', 'return_date'];
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function markAsOverdue()
    {
        // Check if the return date is past the due date
        if ($this->return_date === null && Carbon::now()->greaterThan($this->due_date)) {
            $this->is_overdue = true; // Flagging the borrow as overdue
            $this->save();
            // Additional actions such as triggering notifications can be added here
        }
    }
}
