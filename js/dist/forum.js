module.exports=function(e){var t={};function r(o){if(t[o])return t[o].exports;var n=t[o]={i:o,l:!1,exports:{}};return e[o].call(n.exports,n,n.exports,r),n.l=!0,n.exports}return r.m=e,r.c=t,r.d=function(e,t,o){r.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},r.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r.t=function(e,t){if(1&t&&(e=r(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(r.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var n in e)r.d(o,n,function(t){return e[t]}.bind(null,n));return o},r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,"a",t),t},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r.p="",r(r.s=13)}([function(e,t){e.exports=flarum.core.compat["forum/app"]},function(e,t){e.exports=flarum.core.compat["common/extend"]},,function(e,t){e.exports=flarum.core.compat["common/Model"]},function(e,t){e.exports=flarum.core.compat["common/models/User"]},function(e,t){e.exports=flarum.core.compat["common/components/UsersSearchSource"]},function(e,t){e.exports=flarum.core.compat["common/helpers/highlight"]},function(e,t){e.exports=flarum.core.compat["common/helpers/avatar"]},function(e,t){e.exports=flarum.core.compat["common/helpers/username"]},function(e,t){e.exports=flarum.core.compat["common/components/Link"]},function(e,t){e.exports=flarum.core},function(e,t){e.exports=flarum.core.compat["common/components/TextEditor"]},,function(e,t,r){"use strict";r.r(t);var o=r(3),n=r.n(o),a=r(4),c=r.n(a);function u(){return(u=Object.assign?Object.assign.bind():function(e){for(var t=1;t<arguments.length;t++){var r=arguments[t];for(var o in r)Object.prototype.hasOwnProperty.call(r,o)&&(e[o]=r[o])}return e}).apply(this,arguments)}var i=r(0),s=r.n(i),l=r(1),f=r(5),p=r.n(f),d=r(6),h=r.n(d),x=r(7),g=r.n(x),b=r(8),y=r.n(b),v=r(9),O=r.n(v),j=r(10);r(11);app.initializers.add("kater/ignore-user-extend",(function(){var e;console.log("[kater/ignore-user-extend] Hello, forum!"),c.a.prototype.ignore_all=n.a.attribute("ignore_all"),Object(l.extend)(p.a.prototype,"view",(function(e,t){e.length=0,t=t.toLowerCase();var r=(this.results.get(t)||[]).concat(s.a.store.all("users").filter((function(e){return!e.ignore_all()})).filter((function(e){return[e.username(),e.displayName()].some((function(e){return e.toLowerCase().substr(0,t.length)===t}))}))).filter((function(e,t,r){return r.lastIndexOf(e)===t})).sort((function(e,t){return e.displayName().localeCompare(t.displayName())}));r.length&&[m("li",{className:"Dropdown-header"},s.a.translator.trans("core.forum.search.users_heading"))].concat(r.map((function(e){var r=y()(e),o=[h()(r.text,t)];return m("li",{className:"UserSearchResult","data-index":"users"+e.id()},m(O.a,{href:s.a.route.user(e)},g()(e),u({},r,{text:void 0,children:o})))}))).forEach((function(t){e.push(t)}))})),e=j.compat["mentions/fragments/AutocompleteDropdown"],Object(l.extend)(e.prototype,"render",(function(e){var t=this;this.items.forEach((function(t,r){t.attrs.user&&t.attrs.user.ignore_all()&&e.children.splice(r,1)})),e.children.length<1&&setTimeout((function(){t.hide()}),200)}))}),-1)}]);
//# sourceMappingURL=forum.js.map