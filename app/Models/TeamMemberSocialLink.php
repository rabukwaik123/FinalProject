<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMemberSocialLink extends Model
{
    //
    protected $fillable = [
        'team_member_id',
        'platform_name',
        'url',
    ];

    public function teamMember()
    {
        return $this->belongsTo(TeamMember::class, 'team_member_id', 'id');
    }
}
