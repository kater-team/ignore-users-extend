<?php

namespace Kater\IgnoreUserExtend\Search;

use Flarum\Search\SearchState;
use Flarum\Search\AbstractRegexGambit;

use Flarum\Filter\FilterState;
use Flarum\Filter\FilterInterface;
use Kater\IgnoreUserExtend\Model\IgnoreUser;

/** 用户搜索 屏蔽黑名单 */
class DiscussionIgnoreGambit extends AbstractRegexGambit
{

    // public function getFilterKey(): string
    // {
    //     //[author] => Kater [type] => comment
    //     return 'author';
    // }

    // public function filter(FilterState $filterState, string $filterValue, bool $negate)
    // {
    //     $actor = $filterState->getActor();
    //     $laheide = IgnoreUser::ignore_all($actor->id);

    //     if (sizeof($laheide) > 0) {
    //         $filterState->getQuery()
    //             ->whereNotIn('user_id', $laheide);
    //     }
    // }


    public function getGambitPattern()
    {
        return '[\s\S]*';
    }

    protected function conditions(SearchState $search, array $matches, $negate)
    {
        $actor = $search->getActor();

        $laheide = IgnoreUser::ignore_all($actor->id);

        $search->getQuery()->where('title', 'like', "{$matches[0]}%");
        
        if (sizeof($laheide) > 0) {
            $search->getQuery()
                ->whereNotIn('user_id', $laheide);
        }

        // $search->getQuery()
        // ->whereNotExists(
        //     function ($query) use ($actor) {
        //         // 不搜自己黑名单
        //         $query->from('ignored_user')
        //         ->whereColumn('user_id', 'ignored_user_id')
        //         ->where('user_id', $actor->id);
        //     }
        // )
        // ->whereNotExists(
        //     function ($query) use ($actor) {
        //         // 也不搜拉黑自己的人
        //         $query->from('ignored_user')
        //         ->whereColumn('user_id', 'user_id')
        //         ->where('ignored_user_id', $actor->id);;
        //     }
        // )->where('title', 'like', "{$matches[0]}%");



        // $laheide = IgnoreUser::ignore_all($actor->id);

        
    }
}
