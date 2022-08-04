<?php

namespace Kater\IgnoreUserExtend\Search;

use Flarum\Extension\ExtensionManager;

use Flarum\User\UserRepository;
use Flarum\Search\SearchState;
use Flarum\Search\AbstractRegexGambit;

use Flarum\Filter\FilterState;
use Flarum\Filter\FilterInterface;
use Kater\IgnoreUserExtend\Model\IgnoreUser;

/** 用户搜索 屏蔽黑名单 */
class UserIgnoreGambit extends AbstractRegexGambit
{

    /**
     * @var ExtensionManager
     */
    protected $extensions;

    /**
     * @var UserRepository
     */
    protected $users;

    public function __construct(ExtensionManager $extensions, UserRepository $users)
    {
        $this->extensions = $extensions;
        $this->users = $users;
    }

    public function getGambitPattern()
    {
        return '[\s\S]*';
    }

    /**
     * @param $searchValue
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function getUserSearchSubQuery($searchValue)
    {

        $HasNickName = (bool) $this->extensions->isEnabled('flarum-nicknames');
        if ($HasNickName) {
            return $this->users
                ->query()
                ->select('id')
                ->where('username', 'like', "{$searchValue}%")
                ->orWhere('nickname', 'like', "{$searchValue}%");
        }

        return $this->users
            ->query()
            ->select('id')
            ->where('username', 'like', "{$searchValue}%");
    }

    /** SearchState 兼容 NickName */
    protected function conditions(SearchState $search, array $matches, $negate)
    {
        $actor = $search->getActor();
        $searchValue = $matches[0];
        $HasNickName = (bool) $this->extensions->isEnabled('flarum-nicknames');

        $search->getQuery()->where(function ($query) use ($HasNickName, $searchValue) {
            $user = $query->from('user');
            $user->where('username', 'like', "{$searchValue}%");
            if ($HasNickName) {
                $user->orWhere('nickname', 'like', "{$searchValue}%");
            }
        })->whereNotExists(
            function ($query) use ($actor) {
                // 不搜自己黑名单
                $query->from('ignored_user')
                    ->whereColumn('users.id', 'ignored_user_id')
                    ->where('user_id', $actor->id);
            }
        )->whereNotExists(
            function ($query) use ($actor) {
                // 也不搜拉黑自己的人
                $query->from('ignored_user')
                    ->whereColumn('users.id', 'user_id')
                    ->where('ignored_user_id', $actor->id);;
            }
        );


        // $lahei = IgnoreUser::ignore_all($actor->id);
        // $search->getQuery()
        // ->whereIn("id",$this->getUserSearchSubQuery($searchValue))
        // ->whereNotIn("id",$lahei);
    }
}
