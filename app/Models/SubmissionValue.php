<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionValue extends Model
{
    use HasFactory;

    protected $fillable = ['user_submission_id', 'form_field_id', 'value'];

    public function submission()
    {
        return $this->belongsTo(UserSubmission::class);
    }

    public function field()
    {
        return $this->belongsTo(FormField::class);
    }

    public function formField()
    {
        return $this->belongsTo(FormField::class);
    }
}
