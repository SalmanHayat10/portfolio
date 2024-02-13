app.component('side-bar', {
    props: {
        items: Array,
        baseUrl: String,
        title: String,
    },
    template: document.getElementById('vue-side-bar').innerHTML,
    data() {
        return {
            children: [],
            currentUrl: window.location.pathname
        }
    },
    methods: {
        hasChildren(item, t) {
            // console.log('Item: ', item);
            let tmpChild = [];
            console.log('Selected ITEM: ', item.url);

            _.get(item, 'children', []).map((child, index) => {
                if (_.get(child, 'children.length', 0) > 0) {
                    const tmp = this.hasChildren(child);

                    tmpChild.push(`<div class="dropdown">
                            <ul class="nav nav--no-borders flex-column dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <li class="nav-item">
                                  <a 
                                    class="nav-link" 
                                    :href="${_.get(child, 'children')} && ${_.get(child, 'children.length', 0)} === 0 ? ${this.baseUrl} + val.url : '#'" 
                                    :class="[${this.currentUrl} == (${this.baseUrl} + val.url) ? 'active' : '', ${_.get(child, 'children')} && ${_.get(child, 'children.length', 0)} > 0 ? 'dropdown-toggle' : '']" 
                                    :data-toggle="${_.get(child, 'children')} && ${_.get(child, 'children.length', 0)} > 0 ? 'dropdown' : null" 
                                    :role="${_.get(child, 'children')} && ${_.get(child, 'children.length', 0)} > 0 ? 'button' : null" 
                                    :aria-haspopup="${_.get(child, 'children')} && ${_.get(child, 'children.length', 0)} > 0 ? true : null" 
                                    :aria-expanded="${_.get(child, 'children')} && ${_.get(child, 'children.length', 0)} > 0 ? false : null"
                                  >
                                    <i class="material-icons">${child.icon}</i>
                                    <span>${child.title}</span>
                                  </a>

                                  <div v-if="${_.get(child, 'children')} && ${_.get(child, 'children.length', 0)} > 0" class="dropdown-menu dropdown-menu-small" x-placement="bottom-start" style="display: none; position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-6px, 50px, 0px);">
                                    <a class="dropdown-item" :href="${this.baseUrl} + child.url">{{child.title}}</a>
                                  </div>
                                </li>
                            </ul>
                      </div>`)
                } else {
                    // console.log('TITLE: ', child.icon)

                    tmpChild.push(`<ul class="nav nav--no-borders flex-column">
                        <li class="nav-item dropdown">
                          <a 
                            class="nav-link" 
                            :href="${_.get(child, 'children')} && ${_.get(child, 'children.length', 0)} === 0 ? ${this.baseUrl} + val.url : '#'" 
                            :class="[${this.currentUrl} == (${this.baseUrl} + val.url) ? 'active' : '', ${_.get(child, 'children')} && ${_.get(child, 'children.length', 0)} > 0 ? 'dropdown-toggle' : '']" 
                            :data-toggle="${_.get(child, 'children')} && ${_.get(child, 'children.length', 0)} > 0 ? 'dropdown' : null" 
                            :role="${_.get(child, 'children')} && ${_.get(child, 'children.length', 0)} > 0 ? 'button' : null" 
                            :aria-haspopup="${_.get(child, 'children')} && ${_.get(child, 'children.length', 0)} > 0 ? true : null" 
                            :aria-expanded="${_.get(child, 'children')} && ${_.get(child, 'children.length', 0)} > 0 ? false : null"
                          >
                            <i class="material-icons">${child.icon}</i>
                            <span>${child.title}</span>
                          </a>
                        </li>
                    </ul>`)
                }
            })

            return tmpChild;
        },

        generateMenu() {
            const menuItems = this.items;
            let tmpMenu = [];
            console.log('MENU ITEMS: ', menuItems[0]);

            menuItems.map((item, index) => {
                if (item && _.get(item, 'children.length', 0) > 0) {
                    console.log('SINGLE ITEM: ', item);
                    const tmp = this.hasChildren(item);
                    tmpMenu.push(`<div>
                      <h6 class="sidebar-main-item">${item.title}</h6>
                    </div>`, tmp);
                    // console.log('TMP MENU: ', tmpMenu);
                } else {
                    tmpMenu.push(`<div>
                      <h6 class="sidebar-main-item">${item.title}</h6>
                    </div>`);
                    // console.log('error: ', );
                }
            })

            return tmpMenu;
        },
    },

    mounted() {
        console.log("SIDEBAR component loaded.", this.headerTitle);
        // this.generateMenu()
    }
});