<?php

/*
 * This file is part of kater/ignore-user-extend.
 *
 * Copyright (c) 2022 HHY.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Kater\IgnoreUserExtend;

use Flarum\Extend;
use Flarum\Api\Serializer\UserSerializer;

use Flarum\Discussion\Discussion;
use Flarum\Discussion\Search\DiscussionSearcher;

use Flarum\Post\Post;
use Flarum\Post\Filter\PostFilterer;
use Flarum\Post\Filter\DiscussionFilter;

use Flarum\User\User;
use Flarum\User\Search\UserSearcher;
use Flarum\User\Filter\UserFilterer;


return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js')
        ->css(__DIR__ . '/resources/less/forum.less'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js')
        ->css(__DIR__ . '/resources/less/admin.less'),
    new Extend\Locales(__DIR__ . '/resources/locale'),



    /*** 给用户添加 ignoreAll 拉黑与被拉黑都是 true  */
    (new Extend\ApiSerializer(UserSerializer::class))
        ->attributes(AddUserApiIgnoreList::class),

    /** 搜索模式下 黑名单过滤 */
    (new Extend\SimpleFlarumSearch(UserSearcher::class))
        ->addGambit(Search\UserIgnoreGambit::class),


    // /*** 废弃  因为有搜索引擎 */
    // // (new Extend\SimpleFlarumSearch(DiscussionSearcher::class))
    // //     ->addGambit(Search\DiscussionIgnoreGambit::class),

    // /*** 废弃  因为有搜索引擎 */
    // // (new Extend\Filter(DiscussionFilter::class))
    // //     ->addFilter(Search\DiscussionIgnoreGambit::class),

    // /*** 废弃  因为有搜索引擎 */
    // // (new Extend\Filter(PostFilterer::class))
    // //     ->addFilter(Filter\PostIgnoreFilterGambit::class),


    /** 权限过滤 */
    (new Extend\ModelVisibility(Discussion::class))
        ->scope(Access\ScopeDiscussionVisibility::class, 'view'),

    /** 权限过滤 */
    (new Extend\ModelVisibility(Post::class))
        ->scope(Access\ScopePostVisibility::class, 'view'),

    /*** 废弃 存在权限冲突  */    
    // (new Extend\ModelVisibility(User::class))
    //     ->scope(Access\ScopeUserVisibility::class, "view")

  
];
