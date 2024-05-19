<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kbm extends Model
{
    use HasFactory;
    
    protected $table = 'kbms';

    protected $fillable = [
        'service_name',
        'implementation_side',
        'time_frame',
        'needed_document',
        'fees',
        'legal_document',
        'implementation_procedures',
        'course_of_action',
    ];

    public function scopeOrderByService($query){
        $query->orderBy('service_name');
    }

    public function scopeFilter($query, array $filters){
        
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                // dd($search);
                $query->where('service_name', 'like', '%'.$search.'%')->orWhere('implementation_side', 'like', '%'.$search.'%')->orWhere('needed_document', 'like', '%'.$search.'%')->orWhere('fees', 'like', '%'.$search.'%')->orWhere('legal_document', 'like', '%'.$search.'%')->orWhere('implementation_procedures', 'like', '%'.$search.'%')->orWhere('course_of_action', 'like', '%'.$search.'%');
            });
        });
    }

    public function getCreatedAtAttribute($date){
        return Carbon::parse($date)->format('jS F, Y');
    }
}
