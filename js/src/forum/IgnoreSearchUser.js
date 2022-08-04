import app from 'flarum/forum/app';
import { override } from 'flarum/common/extend';
import UsersSearchSource from 'flarum/common/components/UsersSearchSource';

// 组件
import Link from 'flarum/common/components/Link';

// 工具
import highlight from 'flarum/common/helpers/highlight';
import avatar from 'flarum/common/helpers/avatar';
import username from 'flarum/common/helpers/username';


/** 重写 搜索  过滤黑名单用户  */
export default function () {

    override(UsersSearchSource.prototype, 'view', function (_vi, query) {

        query = query.toLowerCase();
        const results = (this.results.get(query) || [])
            .concat(
                app.store
                    .all('users')
                    .filter((user) => !user.ignore_all())
                    .filter((user) => [user.username(), user.displayName()].some((value) => value.toLowerCase().substr(0, query.length) === query))
            )
            .filter((e, i, arr) => arr.lastIndexOf(e) === i)
            .sort((a, b) => a.displayName().localeCompare(b.displayName()));

        if (!results.length) return [];

        return [
            <li className="Dropdown-header">{app.translator.trans('core.forum.search.users_heading')}</li>,
            ...results.map((user) => {
                const name = username(user);

                const children = [highlight(name.text, query)];

                return (
                    <li className="UserSearchResult" data-index={'users' + user.id()}>
                        <Link href={app.route.user(user)}>
                            {avatar(user)}
                            {{ ...name, text: undefined, children }}
                        </Link>
                    </li>
                );
            }),
        ]

    })
}