<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobListingResponse extends Model
{
    use HasFactory;

    protected $table = 'job_listing_responses';

    protected $fillable = [
        'listing_id',
        'applicant_id',
        'tracking_code',
        'name',
        'email',
        'why_work',
        'why_choose',
        'how_find'
    ];

    public function listing()
    {
        return $this->belongsTo('App\Models\JobListing', 'listing_id');
    }

    public function applicant()
    {
        return $this->belongsTo('App\Models\User', 'applicant_id');
    }

    public function reviewer()
    {
        return $this->belongsTo('App\Models\User', 'reviewer_id');
    }
}
