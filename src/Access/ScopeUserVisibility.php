<?php

namespace Kater\IgnoreUserExtend\Access;

use Flarum\User\User;
use Illuminate\Database\Eloquent\Builder;
use Kater\IgnoreUserExtend\Model\IgnoreUser;

class ScopeUserVisibility
{
    /**
     * @param User $actor
     * @param Builder $query
     */
    public function __invoke(User $actor, $query)
    {
        $laheide = IgnoreUser::ignore_all($actor->id);
        if (sizeof($laheide) > 0) {
            $query->where(function ($query) use ($actor, $laheide) {
                $query->whereNotIn('id', $laheide);
            });         
        }
    }
}
