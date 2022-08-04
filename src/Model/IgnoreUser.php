<?php

namespace Kater\IgnoreUserExtend\Model;

use Flarum\Database\AbstractModel;

class IgnoreUser extends AbstractModel
{
    protected $table = 'ignored_user';

    /** 返回 拉黑的 与被拉黑的 */
    static public function ignore_all(int $user_id): array
    {
        return array_unique(array_merge(self::ignore_ids($user_id), self::ignored_ids($user_id)));
    }

    /** 我拉黑的 */
    static public function ignore_ids(int $user_id): array
    {
        return self::where("user_id", $user_id)->pluck('ignored_user_id')->toArray();
    }
    /** 拉黑我的 */
    static public function ignored_ids(int $user_id): array
    {
        return self::where("ignored_user_id", $user_id)->pluck('user_id')->toArray();
    }
}
