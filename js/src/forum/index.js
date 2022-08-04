import Model from 'flarum/common/Model';
import User from 'flarum/common/models/User';

import IgnoreSearchUser from './IgnoreSearchUser'
import IgnoreMentions from "./IgnoreMentions"


app.initializers.add('kater/ignore-user-extend', () => {
    console.log('[kater/ignore-user-extend] Hello, forum!');

    User.prototype.ignore_all = Model.attribute('ignore_all');

    IgnoreSearchUser()

    IgnoreMentions()
    
}, -1);
