import Model from 'flarum/common/Model';
import User from 'flarum/common/models/User';

import IgnoreSearchUser from './IgnoreSearchUser'
import IgnoreMentions from "./IgnoreMentions"


app.initializers.add('kater/ignore-user-extend', () => {

    User.prototype.ignore_all = Model.attribute('ignore_all');

    /** 用户搜索 黑名单过滤 */
    IgnoreSearchUser()

    /** 富文本 推荐名单过滤  */
    IgnoreMentions()
    
}, -1);
