<?php

/*
 * This file is part of fof/gamification.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Kater\IgnoreUserExtend\Filter;

use Flarum\Filter\FilterInterface;
use Flarum\Filter\FilterState;
use Flarum\Search\AbstractRegexGambit;
use Flarum\Search\SearchState;
use Flarum\User\User;
use Illuminate\Database\Query\Builder;

class PostIgnoreFilterGambit extends AbstractRegexGambit implements FilterInterface
{
    /**
     * {@inheritDoc}
     */
    public function getFilterKey(): string
    {
        //[author] => Kater [type] => comment
        return 'author';
    }

    /**
     * {@inheritDoc}
     */
    public function getGambitPattern()
    {
        return '[\s\S]*';
    }

    /**
     * {@inheritDoc}
     */
    public function filter(FilterState $filterState, string $filterValue, bool $negate)
    {
        // print_r($filterState->getActor());die;
        $this->sort($filterState->getQuery(), $filterState->getActor(), $negate);
    }

    protected function sort(Builder $query, User $actor, bool $negate)
    {
        $query->orderBy('created_at', 'desc');
    }

    /**
     * @param SearchState $search
     * @param array       $matches
     * @param $negate
     */
    protected function conditions(SearchState $search, array $matches, $negate)
    {
        $this->sort($search->getQuery(), $search->getActor(), $negate);
    }
}