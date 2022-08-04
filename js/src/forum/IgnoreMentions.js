import { compat } from '@flarum/core/forum';
import { extend } from 'flarum/common/extend';


/** 过滤 推荐名单  */
export default function () {

    let db = compat['mentions/fragments/AutocompleteDropdown']
    extend(db.prototype, "render", function (vnode) {

        this.items.forEach((ele, index) => {
            if (ele.attrs.user && ele.attrs.user.ignore_all()) {
                vnode.children.splice(index, 1)
            }
        });

        if (vnode.children.length < 1) {
            setTimeout(() => {
                this.hide()
            }, 200)
        }

    })

}
