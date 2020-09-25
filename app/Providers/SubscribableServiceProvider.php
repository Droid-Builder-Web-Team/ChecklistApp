<?php

namespace App\Providers;

use YlsIdeas\SubscribableNotifications\SubscribableApplicationServiceProvider;

class SubscribableServiceProvider extends SubscribableApplicationServiceProvider
{
    /**
     * @var bool
     */
    protected $loadRoutes = true;

    /**
     * @return callable|string
     */
    public function onUnsubscribeFromMailingList()
    {
        return function ($user, $mailingList) {

        };
    }

    /**
     * @return callable|string
     */
    public function onUnsubscribeFromAllMailingLists()
    {
        return function ($user) {
            $user->unsubscribed_at = now();
            $user->save();
        };
    }

    /**
     * @return callable|string
     */
    public function onCompletion()
    {
        return function ($user, $mailingList) {
            return view('confirmation')
                ->with('alert', 'You\'re not unsubscribed');
        };
    }

    /**
     * @return callable|string
     */
    public function onCheckSubscriptionStatusOfMailingList()
    {
        return function ($user, $mailingList) {
            return $user->mailing_lists->get($mailingList, false);
        };
    }


    /**
     * @return callable|string
     */
    public function onCheckSubscriptionStatusOfAllMailingLists()
    {
        return function ($user) {
            return $user->unsubscribed_at === null;
        };
    }
}
