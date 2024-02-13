<!-- Main Sidebar -->
<div id="vue-side-bar">
  <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
    <div class="main-navbar">
      <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap p-0">
        <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
          <div class="d-table m-auto">
            <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;" src="https://designrevision.com/demo/shards-dashboards/images/shards-dashboards-logo.svg" alt="Shards Dashboard">
            <span class="d-none d-md-inline ml-1">{{title}}</span>
          </div>
        </a>
        <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
          <i class="material-icons">&#xE5C4;</i>
        </a>
      </nav>
    </div>

    <div class="nav-wrapper">
      <div style="overflow-y: auto;">
        <div class="" v-for="(item, idx) in items">
          <h6 class="sidebar-main-item">{{item.title}}</h6>

          <ul class="nav nav--no-borders flex-column mb-3">
            <li class="nav-item dropdown" v-for="(val, index) in item.children">
              <a
                class="nav-link" 
                :href="val.url ? baseUrl + val.url : '#'" 
                :class="[currentUrl == (baseUrl + val.url) ? 'active' : '', val.children && val.children.length > 0 ? 'dropdown-toggle' : '']" 
                :data-toggle="val.children && val.children.length > 0 ? 'dropdown' : null" 
                :role="val.children && val.children.length > 0 ? 'button' : null" 
                :aria-haspopup="val.children && val.children.length > 0 ? true : null" 
                :aria-expanded="val.children && val.children.length > 0 ? false : null"
              >
                <i class="material-icons">{{val.icon}}</i>
                <span>{{val.title}}</span>
              </a>

              <div v-if="val.children && val.children.length > 0" class="dropdown-menu dropdown-menu-small" x-placement="bottom-start" style="display: none; position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-6px, 50px, 0px);">
                <a class="dropdown-item" v-for="(child, i) in val.children" :href="child.url ? baseUrl + child.url : '#'">{{child.title}}</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <!-- <div class="nav-wrapper">
      <div style="overflow-y: auto;">
        <div v-html="generateMenu()"></div>
      </div>
    </div> -->
  </aside>
</div>
<!-- End Main Sidebar -->