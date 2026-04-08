<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamMember extends Model
{
    /** @use HasFactory<\Database\Factories\TeamMemberFactory> */
    use HasFactory , SoftDeletes;
    protected $fillable = [
        'name',
        'job_title',
        'image_path',
    ];
    
    public function socialLinks(){
    return $this->hasMany(TeamMemberSocialLink::class, 'team_member_id', 'id');
    }
}
