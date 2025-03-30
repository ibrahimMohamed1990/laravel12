<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Applicant extends Model
{
   protected $fillable = [
      'job_id',
      'user_id',
      'full_name',
      'contact_phone',
      'contact_email',
      'message',
      'location',
      'resume'
   ];

   public function job()
   {
      return $this->belongsTo(Job::class);
   }

   public function user()
   {
      return $this->belongsTo(User::class);
   }

}
