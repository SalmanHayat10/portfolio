<!-- Main Sidebar -->
<div id="vue-side-bar">
  <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
    <div class="main-navbar">
      <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap p-0">
        <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
          <div class="d-table m-auto">
            <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;" src="https://designrevision.com/demo/shards-dashboards/images/shards-dashboards-logo.svg" alt="Shards Dashboard">
            <span class="d-none d-md-inline ml-1">{{headerTitle}}</span>
          </div>
        </a>
        <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
          <i class="material-icons">&#xE5C4;</i>
        </a>
      </nav>
    </div>

    <div class="" style="overflow-y: auto;" v-for="(item, idx) in items">
      <h6 class="sidebar-main-item">{{item.title}}</h6>
      <ul class="nav nav--no-borders flex-column mb-3">
        <li class="nav-item dropdown" v-for="(val, index) in item.children">
          <a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="material-icons"></i>
            <span>{{val.title}}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-small">
            <ul class="nav nav--no-borders flex-column">
              <li class="nav-item dropdown" v-for="(child, index) in val.children">
                <a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons"></i>
                  <span>{{child.title}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-small">
                  <ul class="nav nav--no-borders flex-column">
                    <li class="nav-item dropdown" v-for="(gchild, index) in child.children">
                      <a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons"></i>
                        <span>{{gchild.title}}</span>
                      </a>
                      <div class="dropdown-menu dropdown-menu-small">
                        <ul class="nav nav--no-borders flex-column">
                          <li class="nav-item dropdown" v-for="(kid, index) in gchild.children">
                            <a class="nav-link ">
                              <i class="material-icons"></i>
                              <span>{{kid.title}}</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </aside>
</div>
<!-- End Main Sidebar -->