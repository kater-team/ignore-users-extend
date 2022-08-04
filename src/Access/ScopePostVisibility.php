<?php


namespace Kater\IgnoreUserExtend\Access;

use Flarum\User\User;
use Illuminate\Database\Eloquent\Builder;
use Kater\IgnoreUserExtend\Model\IgnoreUser;

class ScopePostVisibility
{
    /**
     * @param Builder $query
     * @param User $actor
     */
    public function __invoke(User $actor, Builder $query)
    {
      
        $laheide = IgnoreUser::ignore_all($actor->id);
    
        if (sizeof($laheide) > 0) {
            $query->where(function ($query) use ($actor, $laheide) {
                $query->whereNotIn('posts.user_id', $laheide);
            });         
        }
    
        
    }
}
