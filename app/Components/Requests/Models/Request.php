<?php

namespace Handytravelers\Components\Requests\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Handytravelers\Events\InvitationAccepted;
use Handytravelers\Components\Users\Models\User;
use Handytravelers\Components\Places\Models\Place;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Handytravelers\Components\Requests\Exceptions\UserIsNotParticipantException;

class Request extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $dates = ['check_in', 'check_out'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isAPreviousInvitation($user_id)
    {
        return $this->where('user_id', $user_id)->withTrashed()->count();
    }


    public function accept(User $user)
    {
        $this->forceFill([
            'status' => 'accepted',
            'waiting_action' => null
        ])->save();

        return true;
    }

    /**
     * Decline the invitation
     * 
     */
    public function decline()
    {
        $this->forceFill([
            'status' => 'declined',
            'waiting_action' => null
        ])->save();
    }

    /**
     * Close the invitation
     * 
     */
    public function close()
    {
        $this->forceFill([
            'status' => 'closed',
            'waiting_action' => null
        ])->save();
    }

    /**
     * Decline the invitation
     * 
     */
    public function cancel()
    {
        $this->forceFill([
            'status' => 'cancelled',
            'waiting_action' => null
        ])->save();
    }

    public function addMessage($body, $userId)
    {
        return $this->messages()->create([
            'body' => $body,
            'user_id' => $userId,
        ]);
    }

    /**
     * Add users to invitation as participants.
     *
     * @param array|mixed $userId
     */
    public function addParticipants(array $participants)
    {
        collect($participants)->each(function ($participant) {
            $this->participants()->create([
                'user_id' => $participant['user_id'],
                'last_read' => $participant['last_read'],
                'role' => $participant['role'],
            ]);
        });
    }

    /**
     * Mark a invitation as read for a user.
     *
     * @param int $userId
     */
    public function markAsRead($userId)
    {
        $participant = $this->getParticipantFromUser($userId);
        $participant->last_read = new Carbon();
        $participant->save();
    }

    public function isPending()
    {
        if ($this->status == 'pending') {
            return true;
        }

        return false;
    }

    public function isAccepted()
    {
        if ($this->status == 'accepted') {
            return true;
        }

        return false;
    }


    public function isActive()
    {
        if ($this->status == 'pending' || $this->status == 'accepted' || $this->status == 'declined') {
            return true;
        }
    }

    public function isInactive()
    {
        if ($this->status == 'closed' || $this->status == 'cancelled') {
            return true;
        }

        return false;
    }

    public function getUsersWithoutMe($user = null)
    {
        $participants = $this->participants()->withoutUser($user)->get()->pluck('user_id')->all();

        return User::whereIn('id', $participants)->get();
    }


    /**
     * Finds the participant record from a user id.
     *
     * @param $userId
     *
     * @return mixed
     *
     * @throws ModelNotFoundException
     */
    public function getParticipantFromUser($userId)
    {
        return $this->participants()->where('user_id', $userId)->firstOrFail();
    }

    public function isParticipant(User $user)
    {
        try {
            $this->getParticipantFromUser($user->id);
        } catch (ModelNotFoundException $e) {
            throw new UserIsNotParticipantException;
        }
    }

    public function isGuest(User $user)
    {
        if ($this->userRole($user) === "guest") {
            return true;
        }

        return false;
    }

    public function isHost(User $user)
    {
        if ($this->userRole($user) === "host") {
            return true;
        }

        return false;
    }

    public function waitingActionFor()
    {
        return $this->waiting_action;
    }

    /**
     * Check if the user guest/host depending on his/her homeId
     *
     * @return string
     */
    public function userRole(User $user)
    {
        return $this->participants()->userRole($user->id);
    }


    public static function byIdWithRequestAndParticipants($id)
    {
        return static::where('uuid', $id)
            ->with(['messages' => function ($query) {
                $query->orderBy('updated_at', 'DESC');
            }, 'participants.user', 'request', 'messages.user'])->first();
    }

    public function getRequest($uuid)
    {
        return static::where([
            ['uuid', '=', $uuid]
        ])->firstOrFail();
    }

    public function declineOthers()
    {
        static::where([
            ['request_id', '=', $this->request_id],
            ['id', '<>', $this->id]
        ])->update(['status' => 'declined']);
    }


    /**
     * User's relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'participants');
    }


    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * Request relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function request()
    {
        return $this->belongsTo(Request::class);
    }

    /**
     * Messages relationship.
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

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function placeName()
    {
        return $this->place->name;
    }

    /**
     * Returns the user object that created the invitation.
     *
     * @return mixed
     */
    public function creator()
    {
        return $this->messages()->oldest()->first()->user;
    }

    public function lastMessage()
    {
        return $this->messages()->latest()->first()->body;
    }

    public function getTextByUserRole($type)
    {
        if ($type == 'guest') {
            return trans('common.writeHereYourMessage');
        } else {
            return trans('common.writeHereYourMessage');
        }
    }
}
