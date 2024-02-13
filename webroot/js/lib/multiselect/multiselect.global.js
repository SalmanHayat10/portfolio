var VueformMultiselect=function(e,t){"use strict";function u(e){return-1!==[null,void 0,!1].indexOf(e)}function a(e){return(a="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function l(e,t,u){return t in e?Object.defineProperty(e,t,{value:u,enumerable:!0,configurable:!0,writable:!0}):e[t]=u,e}function n(e,t){var u=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),u.push.apply(u,a)}return u}function r(e){return function(e){if(Array.isArray(e))return o(e)}(e)||function(e){if("undefined"!=typeof Symbol&&Symbol.iterator in Object(e))return Array.from(e)}(e)||function(e,t){if(!e)return;if("string"==typeof e)return o(e,t);var u=Object.prototype.toString.call(e).slice(8,-1);"Object"===u&&e.constructor&&(u=e.constructor.name);if("Map"===u||"Set"===u)return Array.from(e);if("Arguments"===u||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(u))return o(e,t)}(e)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function o(e,t){(null==t||t>e.length)&&(t=e.length);for(var u=0,a=new Array(t);u<t;u++)a[u]=e[u];return a}function i(e){var t=!(arguments.length>1&&void 0!==arguments[1])||arguments[1];return t?String(e).toLowerCase().trim():String(e).normalize("NFD").replace(/(?:[\^`\xA8\xAF\xB4\xB7\xB8\u02B0-\u034E\u0350-\u0357\u035D-\u0362\u0374\u0375\u037A\u0384\u0385\u0483-\u0487\u0559\u0591-\u05A1\u05A3-\u05BD\u05BF\u05C1\u05C2\u05C4\u064B-\u0652\u0657\u0658\u06DF\u06E0\u06E5\u06E6\u06EA-\u06EC\u0730-\u074A\u07A6-\u07B0\u07EB-\u07F5\u0818\u0819\u08E3-\u08FE\u093C\u094D\u0951-\u0954\u0971\u09BC\u09CD\u0A3C\u0A4D\u0ABC\u0ACD\u0AFD-\u0AFF\u0B3C\u0B4D\u0B55\u0BCD\u0C4D\u0CBC\u0CCD\u0D3B\u0D3C\u0D4D\u0DCA\u0E47-\u0E4C\u0E4E\u0EBA\u0EC8-\u0ECC\u0F18\u0F19\u0F35\u0F37\u0F39\u0F3E\u0F3F\u0F82-\u0F84\u0F86\u0F87\u0FC6\u1037\u1039\u103A\u1063\u1064\u1069-\u106D\u1087-\u108D\u108F\u109A\u109B\u135D-\u135F\u17C9-\u17D3\u17DD\u1939-\u193B\u1A75-\u1A7C\u1A7F\u1AB0-\u1ABD\u1B34\u1B44\u1B6B-\u1B73\u1BAA\u1BAB\u1C36\u1C37\u1C78-\u1C7D\u1CD0-\u1CE8\u1CED\u1CF4\u1CF7-\u1CF9\u1D2C-\u1D6A\u1DC4-\u1DCF\u1DF5-\u1DF9\u1DFD-\u1DFF\u1FBD\u1FBF-\u1FC1\u1FCD-\u1FCF\u1FDD-\u1FDF\u1FED-\u1FEF\u1FFD\u1FFE\u2CEF-\u2CF1\u2E2F\u302A-\u302F\u3099-\u309C\u30FC\uA66F\uA67C\uA67D\uA67F\uA69C\uA69D\uA6F0\uA6F1\uA700-\uA721\uA788-\uA78A\uA7F8\uA7F9\uA8C4\uA8E0-\uA8F1\uA92B-\uA92E\uA953\uA9B3\uA9C0\uA9E5\uAA7B-\uAA7D\uAABF-\uAAC2\uAAF6\uAB5B-\uAB5F\uAB69-\uAB6B\uABEC\uABED\uFB1E\uFE20-\uFE2F\uFF3E\uFF40\uFF70\uFF9E\uFF9F\uFFE3]|\uD800\uDEE0|\uD802[\uDEE5\uDEE6]|\uD803[\uDD22-\uDD27\uDF46-\uDF50]|\uD804[\uDCB9\uDCBA\uDD33\uDD34\uDD73\uDDC0\uDDCA-\uDDCC\uDE35\uDE36\uDEE9\uDEEA\uDF3C\uDF4D\uDF66-\uDF6C\uDF70-\uDF74]|\uD805[\uDC42\uDC46\uDCC2\uDCC3\uDDBF\uDDC0\uDE3F\uDEB6\uDEB7\uDF2B]|\uD806[\uDC39\uDC3A\uDD3D\uDD3E\uDD43\uDDE0\uDE34\uDE47\uDE99]|\uD807[\uDC3F\uDD42\uDD44\uDD45\uDD97]|\uD81A[\uDEF0-\uDEF4\uDF30-\uDF36]|\uD81B[\uDF8F-\uDF9F\uDFF0\uDFF1]|\uD834[\uDD67-\uDD69\uDD6D-\uDD72\uDD7B-\uDD82\uDD85-\uDD8B\uDDAA-\uDDAD]|\uD838[\uDD30-\uDD36\uDEEC-\uDEEF]|\uD83A[\uDCD0-\uDCD6\uDD44-\uDD46\uDD48-\uDD4A])/g,"").toLowerCase().trim()}function c(t,n,r){var o=e.toRefs(t),c=o.options,s=o.mode,d=o.trackBy,v=o.limit,p=o.hideSelected,f=o.createTag,m=o.label,D=o.appendNewTag,h=o.multipleLabel,g=o.object,b=o.loading,y=o.delay,C=o.resolveOnLoad,F=o.minChars,B=o.filterResults,A=o.clearOnSearch,S=o.clearOnSelect,k=o.valueProp,O=o.canDeselect,E=o.max,w=o.strict,V=o.closeOnSelect,N=r.iv,L=r.ev,q=r.search,P=r.clearSearch,T=r.update,x=r.pointer,j=r.blur,R=r.deactivate,I=e.ref([]),M=e.ref([]),$=e.ref(!1),H=e.computed((function(){var e,t=M.value||[];return e=t,"[object Object]"===Object.prototype.toString.call(e)&&(t=Object.keys(t).map((function(e){var u,a=t[e];return l(u={},k.value,e),l(u,d.value,a),l(u,m.value,a),u}))),t=t.map((function(e,t){var u;return"object"===a(e)?e:(l(u={},k.value,e),l(u,d.value,e),l(u,m.value,e),u)})),I.value.length&&(t=t.concat(I.value)),t})),K=e.computed((function(){var e=H.value;return G.value.length&&(e=G.value.concat(e)),q.value&&B.value&&(e=e.filter((function(e){return-1!==i(e[d.value],w.value).indexOf(i(q.value,w.value))}))),p.value&&(e=e.filter((function(e){return!oe(e)}))),v.value>0&&(e=e.slice(0,v.value)),e})),W=e.computed((function(){switch(s.value){case"single":return!u(N.value[k.value]);case"multiple":case"tags":return!u(N.value)&&N.value.length>0}})),U=e.computed((function(){return void 0!==h&&void 0!==h.value?h.value(N.value):N.value&&N.value.length>1?"".concat(N.value.length," options selected"):"1 option selected"})),_=e.computed((function(){return!H.value.length&&!$.value})),z=e.computed((function(){return H.value.length>0&&0==K.value.length})),G=e.computed((function(){var e;return!1!==f.value&&q.value?-1!==re(q.value)?[]:[(e={},l(e,k.value,q.value),l(e,m.value,q.value),l(e,d.value,q.value),e)]:[]})),J=e.computed((function(){switch(s.value){case"single":return null;case"multiple":case"tags":return[]}})),Q=e.computed((function(){return b.value||$.value})),X=function(e){switch("object"!==a(e)&&(e=ne(e)),s.value){case"single":T(e);break;case"multiple":case"tags":T(N.value.concat(e))}n.emit("select",Z(e),e)},Y=function(e){switch("object"!==a(e)&&(e=ne(e)),s.value){case"single":te();break;case"tags":case"multiple":T(N.value.filter((function(t){return t[k.value]!=e[k.value]})))}n.emit("deselect",Z(e),e)},Z=function(e){return g.value?e:e[k.value]},ee=function(e){Y(e)},te=function(){n.emit("clear"),T(J.value)},ue=function(e){switch(s.value){case"single":return!u(N.value)&&N.value[k.value]==e[k.value];case"tags":case"multiple":return!u(N.value)&&-1!==N.value.map((function(e){return e[k.value]})).indexOf(e[k.value])}},ae=function(e){return!0===e.disabled},le=function(){return!(void 0===E||-1===E.value||!W.value&&E.value>0)&&N.value.length>=E.value},ne=function(e){return H.value[H.value.map((function(e){return String(e[k.value])})).indexOf(String(e))]},re=function(e){return H.value.map((function(e){return i(e[d.value])})).indexOf(i(e))},oe=function(e){return"tags"===s.value&&p.value&&ue(e)},ie=function(e){I.value.push(e)},ce=function(){u(L.value)||(N.value=de(L.value))},se=function(e){$.value=!0,c.value(q.value).then((function(t){M.value=t,"function"==typeof e&&e(t),$.value=!1}))},de=function(e){return u(e)?"single"===s.value?{}:[]:g.value?e:"single"===s.value?ne(e)||{}:e.filter((function(e){return!!ne(e)})).map((function(e){return ne(e)}))};if("single"!==s.value&&!u(L.value)&&!Array.isArray(L.value))throw new Error('v-model must be an array when using "'.concat(s.value,'" mode'));return c&&"function"==typeof c.value?C.value?se(ce):1==g.value&&ce():(M.value=c.value,ce()),y.value>-1&&e.watch(q,(function(e){e.length<F.value||($.value=!0,A.value&&(M.value=[]),setTimeout((function(){e==q.value&&c.value(q.value).then((function(t){e==q.value&&(M.value=t,x.value=K.value.filter((function(e){return!0!==e.disabled}))[0]||null,$.value=!1)}))}),y.value))}),{flush:"sync"}),e.watch(L,(function(e){var t,a,l;if(u(e))N.value=de(e);else switch(s.value){case"single":(g.value?e[k.value]!=N.value[k.value]:e!=N.value[k.value])&&(N.value=de(e));break;case"multiple":case"tags":t=g.value?e.map((function(e){return e[k.value]})):e,a=N.value.map((function(e){return e[k.value]})),l=a.slice().sort(),t.length===a.length&&t.slice().sort().every((function(e,t){return e===l[t]}))||(N.value=de(e))}}),{deep:!0}),"function"!=typeof t.options&&e.watch(c,(function(e,u){M.value=t.options,Object.keys(N.value).length||ce(),function(){if(W.value)if("single"===s.value){var e=ne(N.value[k.value])[m.value];N.value[m.value]=e,g.value&&(L.value[m.value]=e)}else N.value.forEach((function(e,t){var u=ne(N.value[t][k.value])[m.value];N.value[t][m.value]=u,g.value&&(L.value[t][m.value]=u)}))}()})),{fo:K,filteredOptions:K,hasSelected:W,multipleLabelText:U,eo:H,extendedOptions:H,noOptions:_,noResults:z,resolving:$,busy:Q,select:X,deselect:Y,remove:ee,clear:te,isSelected:ue,isDisabled:ae,isMax:le,getOption:ne,handleOptionClick:function(e){if(!ae(e)){switch(s.value){case"single":if(ue(e))return void(O.value&&Y(e));j(),X(e);break;case"multiple":if(ue(e))return void Y(e);if(le())return;X(e),S.value&&P();break;case"tags":if(ue(e))return void Y(e);if(le())return;void 0===ne(e[k.value])&&f.value&&(n.emit("tag",e[k.value]),D.value&&ie(e),P()),S.value&&P(),X(e)}V.value&&R()}},handleTagRemove:function(e,t){0===t.button?ee(e):t.preventDefault()},refreshOptions:function(e){se(e)},resolveOptions:se}}function s(t,u,a){var r=e.toRefs(t),o=r.disabled,i=r.openDirection,c=r.showOptions,s=a.isOpen,d=a.isPointed,v=a.isSelected,p=a.isDisabled,f=a.isActive,m=function(e){for(var t=1;t<arguments.length;t++){var u=null!=arguments[t]?arguments[t]:{};t%2?n(Object(u),!0).forEach((function(t){l(e,t,u[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(u)):n(Object(u)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(u,t))}))}return e}({container:"multiselect",containerDisabled:"is-disabled",containerOpen:"is-open",containerOpenTop:"is-open-top",containerActive:"is-active",singleLabel:"multiselect-single-label",multipleLabel:"multiselect-multiple-label",search:"multiselect-search",tags:"multiselect-tags",tag:"multiselect-tag",tagDisabled:"is-disabled",tagRemove:"multiselect-tag-remove",tagRemoveIcon:"multiselect-tag-remove-icon",tagsSearchWrapper:"multiselect-tags-search-wrapper",tagsSearch:"multiselect-tags-search",tagsSearchCopy:"multiselect-tags-search-copy",placeholder:"multiselect-placeholder",caret:"multiselect-caret",caretOpen:"is-open",clear:"multiselect-clear",clearIcon:"multiselect-clear-icon",spinner:"multiselect-spinner",dropdown:"multiselect-dropdown",dropdownTop:"is-top",dropdownHidden:"is-hidden",options:"multiselect-options",optionsTop:"is-top",option:"multiselect-option",optionPointed:"is-pointed",optionSelected:"is-selected",optionDisabled:"is-disabled",optionSelectedPointed:"is-selected is-pointed",optionSelectedDisabled:"is-selected is-disabled",noOptions:"multiselect-no-options",noResults:"multiselect-no-results",fakeInput:"multiselect-fake-input",spacer:"multiselect-spacer"},r.classes.value);return{classList:e.computed((function(){return{container:[m.container].concat(o.value?m.containerDisabled:[]).concat(s.value&&"top"===i.value&&c.value?m.containerOpenTop:[]).concat(s.value&&"top"!==i.value&&c.value?m.containerOpen:[]).concat(f.value?m.containerActive:[]),spacer:m.spacer,singleLabel:m.singleLabel,multipleLabel:m.multipleLabel,search:m.search,tags:m.tags,tag:[m.tag].concat(o.value?m.tagDisabled:[]),tagRemove:m.tagRemove,tagRemoveIcon:m.tagRemoveIcon,tagsSearchWrapper:m.tagsSearchWrapper,tagsSearch:m.tagsSearch,tagsSearchCopy:m.tagsSearchCopy,placeholder:m.placeholder,caret:[m.caret].concat(s.value?m.caretOpen:[]),clear:m.clear,clearIcon:m.clearIcon,spinner:m.spinner,dropdown:[m.dropdown].concat("top"===i.value?m.dropdownTop:[]).concat(s.value&&c.value?[]:m.dropdownHidden),options:[m.options].concat("top"===i.value?m.optionsTop:[]),option:function(e){var t=[m.option];return d(e)?t.push(v(e)?m.optionSelectedPointed:m.optionPointed):v(e)?t.push(p(e)?m.optionSelectedDisabled:m.optionSelected):p(e)&&t.push(m.optionDisabled),t},noOptions:m.noOptions,noResults:m.noResults,fakeInput:m.fakeInput}}))}}var d={name:"Multiselect",emits:["open","close","select","deselect","input","search-change","tag","update:modelValue","change","clear"],props:{value:{required:!1},modelValue:{required:!1},options:{type:[Array,Object,Function],required:!1,default:()=>[]},id:{type:[String,Number],required:!1},name:{type:[String,Number],required:!1,default:"multiselect"},disabled:{type:Boolean,required:!1,default:!1},label:{type:String,required:!1,default:"label"},trackBy:{type:String,required:!1,default:"label"},valueProp:{type:String,required:!1,default:"value"},placeholder:{type:String,required:!1,default:null},mode:{type:String,required:!1,default:"single"},searchable:{type:Boolean,required:!1,default:!1},limit:{type:Number,required:!1,default:-1},hideSelected:{type:Boolean,required:!1,default:!0},createTag:{type:Boolean,required:!1,default:!1},appendNewTag:{type:Boolean,required:!1,default:!0},caret:{type:Boolean,required:!1,default:!0},loading:{type:Boolean,required:!1,default:!1},noOptionsText:{type:String,required:!1,default:"The list is empty"},noResultsText:{type:String,required:!1,default:"No results found"},multipleLabel:{type:Function,required:!1},object:{type:Boolean,required:!1,default:!1},delay:{type:Number,required:!1,default:-1},minChars:{type:Number,required:!1,default:0},resolveOnLoad:{type:Boolean,required:!1,default:!0},filterResults:{type:Boolean,required:!1,default:!0},clearOnSearch:{type:Boolean,required:!1,default:!1},clearOnSelect:{type:Boolean,required:!1,default:!0},canDeselect:{type:Boolean,required:!1,default:!0},canClear:{type:Boolean,required:!1,default:!0},max:{type:Number,required:!1,default:-1},showOptions:{type:Boolean,required:!1,default:!0},addTagOn:{type:Array,required:!1,default:()=>["enter"]},required:{type:Boolean,required:!1,default:!1},openDirection:{type:String,required:!1,default:"bottom"},nativeSupport:{type:Boolean,required:!1,default:!1},classes:{type:Object,required:!1,default:()=>({})},strict:{type:Boolean,required:!1,default:!0},closeOnSelect:{type:Boolean,required:!1,default:!0}},setup(t,a){const l=function(t,u){var a=e.toRefs(t),l=a.value,n=a.modelValue,r=a.mode,o=a.valueProp,i=e.ref("single"!==r.value?[]:{}),c=void 0!==u.expose?n:l,s=e.computed((function(){return"single"===r.value?i.value[o.value]:i.value.map((function(e){return e[o.value]}))})),d=e.computed((function(){return"single"!==r.value?i.value.map((function(e){return e[o.value]})).join(","):i.value[o.value]}));return{iv:i,internalValue:i,ev:c,externalValue:c,textValue:d,plainValue:s}}(t,a),n={pointer:e.ref(null)},o=function(t,u,a){var l=e.toRefs(t).disabled,n=e.ref(!1);return{isOpen:n,open:function(){n.value||l.value||(n.value=!0,u.emit("open"))},close:function(){n.value&&(n.value=!1,u.emit("close"))}}}(t,a),i=function(t,u,a){var l=e.ref(null),n=e.ref(null);return e.watch(l,(function(e){u.emit("search-change",e)})),{search:l,input:n,clearSearch:function(){l.value=""},handleSearchInput:function(e){l.value=e.target.value}}}(0,a),d=function(t,a,l){var n=e.toRefs(t),r=n.object,o=n.valueProp,i=n.mode,c=l.iv,s=function(e){return r.value||u(e)?e:Array.isArray(e)?e.map((function(e){return e[o.value]})):e[o.value]},d=function(e){return u(e)?"single"===i.value?{}:[]:e};return{update:function(e){c.value=d(e);var t=s(e);a.emit("change",t),a.emit("input",t),a.emit("update:modelValue",t)}}}(t,a,{iv:l.iv}),v=function(t,u,a){var l=e.toRefs(t),n=l.searchable,r=l.disabled,o=a.input,i=a.open,c=a.close,s=a.clearSearch,d=e.ref(null),v=e.ref(!1),p=e.computed((function(){return n.value||r.value?-1:0})),f=function(){n.value&&o.value.blur(),d.value.blur()},m=function(){v.value=!1,setTimeout((function(){v.value||(c(),s())}),1)};return{multiselect:d,tabindex:p,isActive:v,blur:f,handleFocus:function(){n.value&&!r.value&&o.value.focus()},activate:function(){r.value||(v.value=!0,i())},deactivate:m,handleCaretClick:function(){m(),f()}}}(t,0,{input:i.input,open:o.open,close:o.close,clearSearch:i.clearSearch}),p=c(t,a,{ev:l.ev,iv:l.iv,search:i.search,clearSearch:i.clearSearch,update:d.update,pointer:n.pointer,blur:v.blur,deactivate:v.deactivate}),f=function(t,u,a){var l=e.toRefs(t),n=l.valueProp,r=l.showOptions,o=l.searchable,i=a.fo,c=a.handleOptionClick,s=a.search,d=a.pointer,v=a.multiselect,p=e.computed((function(){return i.value.filter((function(e){return!0!==e.disabled}))})),f=function(e){void 0===e||null!==e&&e.disabled||(d.value=e)},m=function(){f(p.value[0]||null)},D=function(){f(null)},h=function(){var e=v.value.querySelector("[data-pointed]");if(e){var t=e.parentElement.parentElement;e.offsetTop+e.offsetHeight>t.clientHeight+t.scrollTop&&(t.scrollTop=e.offsetTop+e.offsetHeight-t.clientHeight),e.offsetTop<t.scrollTop&&(t.scrollTop=e.offsetTop)}};return e.watch(s,(function(e){o.value&&(e.length&&r.value?m():D())})),{pointer:d,isPointed:function(e){return!!d.value&&d.value[n.value]==e[n.value]},setPointer:f,setPointerFirst:m,clearPointer:D,selectPointer:function(){d.value&&!0!==d.value.disabled&&c(d.value)},forwardPointer:function(){if(null===d.value)f(p.value[0]||null);else{var t=p.value.map((function(e){return e[n.value]})).indexOf(d.value[n.value])+1;p.value.length<=t&&(t=0),f(p.value[t]||null)}e.nextTick((function(){h()}))},backwardPointer:function(){if(null===d.value)f(p.value[p.value.length-1]||null);else{var t=p.value.map((function(e){return e[n.value]})).indexOf(d.value[n.value])-1;t<0&&(t=p.value.length-1),f(p.value[t]||null)}e.nextTick((function(){h()}))}}}(t,0,{fo:p.fo,handleOptionClick:p.handleOptionClick,search:i.search,pointer:n.pointer,multiselect:v.multiselect}),m=function(t,u,a){var l=e.toRefs(t),n=l.mode,o=l.addTagOn,i=l.createTag,c=l.openDirection,s=l.searchable,d=l.showOptions,v=l.valueProp,p=a.iv,f=a.update,m=a.search,D=a.setPointer,h=a.selectPointer,g=a.backwardPointer,b=a.forwardPointer,y=a.blur,C=a.fo,F=function(){"tags"===n.value&&!d.value&&i.value&&s.value&&D(C.value[C.value.map((function(e){return e[v.value]})).indexOf(m.value)]),h()};return{handleKeydown:function(e){switch(e.keyCode){case 8:if("single"===n.value)return;if(s.value&&-1===[null,""].indexOf(m.value))return;if(0===p.value.length)return;f(r(p.value).slice(0,-1));break;case 13:if(e.preventDefault(),"tags"===n.value&&-1===o.value.indexOf("enter"))return;F();break;case 27:y();break;case 32:if("tags"!==n.value&&s.value)return;if("tags"===n.value&&-1===o.value.indexOf("space"))return;e.preventDefault(),F();break;case 38:if(e.preventDefault(),!d.value)return;"top"===c.value?b():g();break;case 40:if(e.preventDefault(),!d.value)return;"top"===c.value?g():b();break;case 186:if("tags"!==n.value)return;if(-1===o.value.indexOf(";")||!i.value)return;F(),e.preventDefault();break;case 188:if("tags"!==n.value)return;if(-1===o.value.indexOf(",")||!i.value)return;F(),e.preventDefault()}}}}(t,0,{iv:l.iv,update:d.update,search:i.search,setPointer:f.setPointer,selectPointer:f.selectPointer,backwardPointer:f.backwardPointer,forwardPointer:f.forwardPointer,blur:v.blur,fo:p.fo}),D=s(t,0,{isOpen:o.isOpen,isPointed:f.isPointed,isSelected:p.isSelected,isDisabled:p.isDisabled,isActive:v.isActive});return{...l,...o,...v,...n,...d,...i,...p,...f,...m,...D}}};return d.render=function(e,u,a,l,n,r){return t.openBlock(),t.createBlock("div",{ref:"multiselect",tabindex:e.tabindex,class:e.classList.container,id:a.id,onFocusin:u[5]||(u[5]=(...t)=>e.activate&&e.activate(...t)),onFocusout:u[6]||(u[6]=(...t)=>e.deactivate&&e.deactivate(...t)),onKeydown:u[7]||(u[7]=(...t)=>e.handleKeydown&&e.handleKeydown(...t)),onFocus:u[8]||(u[8]=(...t)=>e.handleFocus&&e.handleFocus(...t))},[t.createCommentVNode(" Search "),"tags"!==a.mode&&a.searchable&&!a.disabled?(t.openBlock(),t.createBlock("input",{key:0,modelValue:e.search,value:e.search,class:e.classList.search,onInput:u[1]||(u[1]=(...t)=>e.handleSearchInput&&e.handleSearchInput(...t)),ref:"input"},null,42,["modelValue","value"])):t.createCommentVNode("v-if",!0),t.createCommentVNode(" Tags (with search) "),"tags"==a.mode?(t.openBlock(),t.createBlock("div",{key:1,class:e.classList.tags},[(t.openBlock(!0),t.createBlock(t.Fragment,null,t.renderList(e.iv,((u,l,n)=>t.renderSlot(e.$slots,"tag",{option:u,handleTagRemove:e.handleTagRemove,disabled:a.disabled},(()=>[(t.openBlock(),t.createBlock("span",{class:e.classList.tag,key:n},[t.createTextVNode(t.toDisplayString(u[a.label])+" ",1),a.disabled?t.createCommentVNode("v-if",!0):(t.openBlock(),t.createBlock("span",{key:0,class:e.classList.tagRemove,onMousedown:t.withModifiers((t=>e.handleTagRemove(u,t)),["prevent"])},[t.createVNode("span",{class:e.classList.tagRemoveIcon},null,2)],42,["onMousedown"]))],2))])))),256)),t.createVNode("div",{class:e.classList.tagsSearchWrapper},[t.createCommentVNode(" Used for measuring search width "),t.createVNode("span",{class:e.classList.tagsSearchCopy},t.toDisplayString(e.search),3),t.createCommentVNode(" Actual search input "),a.searchable&&!a.disabled?(t.openBlock(),t.createBlock("input",{key:0,modelValue:e.search,value:e.search,class:e.classList.tagsSearch,onInput:u[2]||(u[2]=(...t)=>e.handleSearchInput&&e.handleSearchInput(...t)),ref:"input"},null,42,["modelValue","value"])):t.createCommentVNode("v-if",!0)],2)],2)):t.createCommentVNode("v-if",!0),t.createCommentVNode(" Single label "),"single"==a.mode&&e.hasSelected&&!e.search&&e.iv?t.renderSlot(e.$slots,"singlelabel",{key:2,value:e.iv},(()=>[t.createVNode("div",{class:e.classList.singleLabel},t.toDisplayString(e.iv[a.label]),3)])):t.createCommentVNode("v-if",!0),t.createCommentVNode(" Multiple label "),"multiple"==a.mode&&e.hasSelected&&!e.search?t.renderSlot(e.$slots,"multiplelabel",{key:3,values:e.iv},(()=>[t.createVNode("div",{class:e.classList.multipleLabel},t.toDisplayString(e.multipleLabelText),3)])):t.createCommentVNode("v-if",!0),t.createCommentVNode(" Placeholder "),!a.placeholder||e.hasSelected||e.search?t.createCommentVNode("v-if",!0):t.renderSlot(e.$slots,"placeholder",{key:4},(()=>[t.createVNode("div",{class:e.classList.placeholder},t.toDisplayString(a.placeholder),3)])),t.createCommentVNode(" Spinner "),e.busy?t.renderSlot(e.$slots,"spinner",{key:5},(()=>[t.createVNode("span",{class:e.classList.spinner},null,2)])):t.createCommentVNode("v-if",!0),t.createCommentVNode(" Clear "),e.hasSelected&&!a.disabled&&a.canClear&&!e.busy?t.renderSlot(e.$slots,"clear",{key:6,clear:e.clear},(()=>[t.createVNode("span",{class:e.classList.clear,onMousedown:u[3]||(u[3]=(...t)=>e.clear&&e.clear(...t))},[t.createVNode("span",{class:e.classList.clearIcon},null,2)],34)])):t.createCommentVNode("v-if",!0),t.createCommentVNode(" Caret "),a.caret?t.renderSlot(e.$slots,"caret",{key:7},(()=>[t.createVNode("span",{class:e.classList.caret,onClick:u[4]||(u[4]=(...t)=>e.handleCaretClick&&e.handleCaretClick(...t))},null,2)])):t.createCommentVNode("v-if",!0),t.createCommentVNode(" Options "),t.createVNode("div",{class:e.classList.dropdown,tabindex:"-1"},[t.renderSlot(e.$slots,"beforelist",{options:e.fo}),t.createVNode("ul",{class:e.classList.options},[(t.openBlock(!0),t.createBlock(t.Fragment,null,t.renderList(e.fo,((u,l,n)=>(t.openBlock(),t.createBlock("li",{class:e.classList.option(u),key:n,"data-pointed":e.isPointed(u),onMouseenter:t=>e.setPointer(u),onClick:t=>e.handleOptionClick(u)},[t.renderSlot(e.$slots,"option",{option:u,search:e.search},(()=>[t.createVNode("span",null,t.toDisplayString(u[a.label]),1)]))],42,["data-pointed","onMouseenter","onClick"])))),128))],2),e.noOptions?t.renderSlot(e.$slots,"nooptions",{key:0},(()=>[t.createVNode("div",{class:e.classList.noOptions,innerHTML:a.noOptionsText},null,10,["innerHTML"])])):t.createCommentVNode("v-if",!0),e.noResults?t.renderSlot(e.$slots,"noresults",{key:1},(()=>[t.createVNode("div",{class:e.classList.noResults,innerHTML:a.noResultsText},null,10,["innerHTML"])])):t.createCommentVNode("v-if",!0),t.renderSlot(e.$slots,"afterlist",{options:e.fo})],2),t.createCommentVNode(" Hacky input element to show HTML5 required warning "),a.required?(t.openBlock(),t.createBlock("input",{key:8,class:e.classList.fakeInput,tabindex:"-1",value:e.textValue,required:""},null,10,["value"])):t.createCommentVNode("v-if",!0),t.createCommentVNode(" Native input support "),a.nativeSupport?(t.openBlock(),t.createBlock(t.Fragment,{key:9},["single"==a.mode?(t.openBlock(),t.createBlock("input",{key:0,type:"hidden",name:a.name,value:void 0!==e.plainValue?e.plainValue:""},null,8,["name","value"])):(t.openBlock(!0),t.createBlock(t.Fragment,{key:1},t.renderList(e.plainValue,((e,u)=>(t.openBlock(),t.createBlock("input",{type:"hidden",name:`${a.name}[]`,value:e,key:u},null,8,["name","value"])))),128))],64)):t.createCommentVNode("v-if",!0),t.createCommentVNode(" Create height for empty input "),t.createVNode("div",{class:e.classList.spacer},null,2)],42,["tabindex","id"])},d.__file="src/Multiselect.vue",d}(Vue,Vue);