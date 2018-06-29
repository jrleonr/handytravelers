<?php

namespace Handytravelers\Components\Users\Traits;

use Handytravelers\Components\Requests\Models\Request;

trait Messagable
{
    /**
     * Message relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Participants relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    /**
     * Thread relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function participant()
    {
        return $this->belongsToMany(Request::class, 'participants');
    }

    /**
     * Returns the new messages count for user.
     *
     * @return int
     */
    public function newMessagesCount()
    {
        return $this->requestsWithNewMessages()->count();
    }

    /**
     * Returns all threads with new messages.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function requestsWithNewMessages()
    {
        return $this->participant()->where(function ($q) {
                $q->whereNull('participants.last_read');
                $q->orWhere('requests.updated_at', '>', $this->getConnection()->raw( 'participants.last_read'));
            })->get();
    }

}
