<nav id="VueMenu" class="navbar horizontal-layout-2 col-lg-12 col-12 p-0 d-flex flex-row align-items-start">
  <div class="container">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
      <a class="navbar-brand brand-logo" href="../../index.html">
        <img src="http://localhost/GerenciadorDeCarteira/chroma/images/logo.svg" alt="logo" />
      </a>
      <a class="navbar-brand brand-logo-mini" href="../../index.html">
        <img src="http://localhost/GerenciadorDeCarteira/chroma/images/logo-mini.svg" alt="logo" />
      </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center pr-0">
      <!--
      <ul class="navbar-nav header-links">
        <li class="nav-item">
          <a href="#" class="nav-link">Schedule
            <span class="badge badge-success ml-1">New</span>
          </a>
        </li>
        <li class="nav-item active">
          <a href="#" class="nav-link">
            <i class="mdi mdi-elevation-rise"></i>Reports</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="mdi mdi-bookmark-plus-outline"></i>Score</a>
        </li>
      </ul>
      -->
      <ul class="navbar-nav ml-auto dropdown-menus">
        <!--
        <li class="nav-item dropdown">
          <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
            <i class="mdi mdi-message-text-outline"></i>
            <span class="count bg-warning">2</span>
          </a>
          <div class="dropdown-menu dropdown-menu-left navbar-dropdown preview-list" aria-labelledby="messageDropdown">
            <div class="dropdown-item py-3">
              <p class="mb-0 font-weight-medium float-left">You have 7 unread mails
              </p>
              <span class="badge badge-inverse-info badge-pill float-right">View all</span>
            </div>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <img src="https://www.placehold.it/36x36" alt="image" class="profile-pic">
              </div>
              <div class="preview-item-content flex-grow">
                <h6 class="preview-subject ellipsis font-weight-normal text-dark mb-1">David Grey
                  <span class="float-right font-weight-light small-text text-gray">1 Minutes ago</span>
                </h6>
                <p class="font-weight-light small-text mb-0">
                  The meeting is cancelled
                </p>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <img src="https://www.placehold.it/36x36" alt="image" class="profile-pic">
              </div>
              <div class="preview-item-content flex-grow">
                <h6 class="preview-subject ellipsis font-weight-normal text-dark mb-1">Tim Cook
                  <span class="float-right font-weight-light small-text text-gray">15 Minutes ago</span>
                </h6>
                <p class="font-weight-light small-text mb-0">
                  New product launch
                </p>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <img src="https://www.placehold.it/36x36" alt="image" class="profile-pic">
              </div>
              <div class="preview-item-content flex-grow">
                <h6 class="preview-subject ellipsis font-weight-normal text-dark mb-1"> Johnson
                  <span class="float-right font-weight-light small-text text-gray">18 Minutes ago</span>
                </h6>
                <p class="font-weight-light small-text mb-0">
                  Upcoming board meeting
                </p>
              </div>
            </a>
          </div>

        </li>
        -->
        <li class="nav-item dropdown">
          <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
            <i class="mdi mdi-bell-outline"></i>
            <span class="count bg-success">4</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
            <a class="dropdown-item py-3">
              <p class="mb-0 font-weight-medium float-left">You have 4 new notifications
              </p>
              <span class="badge badge-pill badge-inverse-info float-right">View all</span>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-inverse-success">
                  <i class="mdi mdi-alert-circle-outline mx-0"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <h6 class="preview-subject font-weight-normal text-dark mb-1">Application Error</h6>
                <p class="font-weight-light small-text mb-0">
                  Just now
                </p>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-inverse-warning">
                  <i class="mdi mdi-comment-text-outline mx-0"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <h6 class="preview-subject font-weight-normal text-dark mb-1">Settings</h6>
                <p class="font-weight-light small-text mb-0">
                  Private message
                </p>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-inverse-info">
                  <i class="mdi mdi-email-outline mx-0"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <h6 class="preview-subject font-weight-normal text-dark mb-1">New user registration</h6>
                <p class="font-weight-light small-text mb-0">
                  2 days ago
                </p>
              </div>
            </a>
          </div>
        </li>
        <li class="nav-item mr-0">
          <a :href="window.MyUrl + LinkCadUser" class="nav-link py-0 pr-0">
            <span class="text-black d-none d-lg-inline-block text-white mr-2">Olá, {{UserName}} !</span>
            <!--<img class="img-xs rounded-circle" src="https://www.placehold.it/37x37" alt="profile image">-->
          </a>
        </li>
      </ul>
      <button @click="MenuMin" type="button" class="navbar-toggler d-block d-md-none">
        <i class="mdi mdi-menu"></i>
      </button>
    </div>
  </div>
  <div class="container">
    <div class="nav-bottom">
      <ul class="navbar-nav">
        <li v-for="Menu in MenuJson" class="nav-item dropdown">
          <a v-if="Menu.children.length > 0 && Menu.visible" class="nav-link count-indicator dropdown-toggle" :id="Menu.id" href="" data-toggle="dropdown">
            {{Menu.name}}
          </a>
          <a v-else-if="Menu.visible" class="nav-link count-indicator dropdown-toggle" :id="Menu.id" :href="window.MyUrl + Menu.link" >
            {{Menu.name}}
          </a>
          <div v-if="Menu.children.length > 0" class="dropdown-menu dropdown-left navbar-dropdown" :aria-labelledby="Menu.id">
            <ul>
              <li v-for="SubMenu in Menu.children" class="dropdown-item">
                <a v-if="SubMenu.visible" :href="window.MyUrl + SubMenu.link" class="dropdown-link">{{SubMenu.name}}</a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>