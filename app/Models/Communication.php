<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Communication extends Model
{
    protected $fillable = [
        'family_id',
        'sent_by',
        'communication_type', // email, sms, mail, phone
        'subject',
        'content',
        'sent_at',
        'response_received',
        'response_content',
        'follow_up_required',
        'follow_up_date',
        'status',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
        'response_received' => 'boolean',
        'follow_up_required' => 'boolean',
        'follow_up_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the family that the communication belongs to.
     */
    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }

    /**
     * Get the user who sent the communication.
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sent_by');
    }
}
