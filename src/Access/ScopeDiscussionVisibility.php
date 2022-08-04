<?php


namespace Kater\IgnoreUserExtend\Access;

use Flarum\User\User;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Kater\IgnoreUserExtend\Model\IgnoreUser;

/** 黑名单人员不可见 */
class ScopeDiscussionVisibility
{
 

    /**
     * @param User            $actor
     * @param EloquentBuilder $query
     */
    public function __invoke(User $actor, EloquentBuilder $query)
    {
       
        $laheide = IgnoreUser::ignore_all($actor->id);

        if (sizeof($laheide) > 0) {
            $query->where(function ($query) use ($actor, $laheide) {
                $query->whereNotIn('discussions.user_id', $laheide);
            });         
        }

    }
}
