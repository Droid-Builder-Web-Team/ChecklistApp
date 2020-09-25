<?php

namespace App;

use App\Task;
use App\Droid;
use Cache;
use App\UserProfile;
use Laravel\Passport\HasApiTokens;
use App\Notification\NewDroidAdded;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use YlsIdeas\SubscribableNotifications\Facades\Subscriber;
use YlsIdeas\SubscribableNotifications\MailSubscriber;
use YlsIdeas\SubscribableNotifications\Contracts\CanUnsubscribe;
use YlsIdeas\SubscribableNotifications\Contracts\CheckSubscriptionStatusBeforeSendingNotifications;


class User extends Authenticatable implements MustVerifyEmail, CanUnsubscribe, CheckSubscriptionStatusBeforeSendingNotifications
{
    use HasApiTokens, Notifiable, MailSubscriber;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname',
        'lname',
        'uname',
        'email',
        'avatar',
        'password',
        'email_verified_at',
        'last_activity',
        'accepted_gdpr',
        'isAnonymized'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function hasAnyRoles($roles)
    {
        if($this->roles()->whereIn('name', $roles)->first())
        {
            return true;
        }

        return false;
    }
    public function hasRole($role)
    {
        if($this->roles()->where('name', $role)->first())
        {
            return true;
        }

        return false;
    }

    public function droids()
    {
        return $this->belongsToMany(Droid::class);
    }

    public function hasDroid(Droid $droid)
    {
        return $this->droid->contains($droid);
    }

    public function profile()
    {
        return $this->hasOne('\App\UserProfile');
    }

    public function uname()
    {
        return $this->uname;
    }

    public function name()
    {
        return $this->fname . " " . $this->lname;
    }

    public function getProfile()
    {
        return \App\UserProfile::where('user_id', $this->id)->first();
    }

    public function getAvatarUrl()
    {
        $profile = $this->getProfile();
        if (isset($profile->avatar))
        {
            return Storage::url('avatars/' . $profile->avatar);
        }
        else
        {
            return null;
        }
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    public function mailSubscriptionStatus(Notification $notification) : bool
    {
        return Subscriber::checkSubscriptionStatus(
            $this,
            $notification instanceof AppliesToMailingList
                ? $notification->usesMailingList()
                : null
        );
    }
}
