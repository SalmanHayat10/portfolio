<div>
    <dashboard></dashboard>
</div>
<section class="content d-none" id="dashboard">
  <div class="main-content-container container-fluid">
    <!-- Page Header -->
    <div class="page-header row g-3 py-4">
      <div class="col-12 col-lg-8 col-md-8 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">My-portfolio</span>
        <h3 class="page-title">Welcome, <?= ucwords($user['name']) ?></h3>
      </div>
      
    </div>
    <!-- End Page Header -->
  

    <!-- Dashboard Kpi Section -->
    <div>
      <div class="row g-3">
      <div class="col-6 col-md-4 col-lg-2 pb-2">
          <div>
            <Kpi title="Admins" model="Admins" :query="{ where: { is_deleted: 0 } }" ></Kpi>
          </div>
        </div>
        <!-- <div class="col-6 col-md-4 col-lg-2 pb-2">
          <div>
            <Kpi title="Servies" model="Services" :query="{ where: { is_deleted: 0 } }"></Kpi>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2 pb-2">
          <div>
            <Kpi title="Reviews" model="Reviews" :query="{ where: { is_deleted: 0 } }"></Kpi>
          </div>
        </div> -->
        <div class="col-6 col-md-4 col-lg-2 pb-2">
          <div>
            <Kpi title="About" model="Abouts" :query="{ where: { is_deleted: 0 } }"></Kpi>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2 pb-2">
          <div>
            <Kpi title="Blogs" model="Blogs" :query="{ where: { is_deleted: 0 } }"></Kpi>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2 pb-2">
          <div>
            <Kpi title="Projects" model="Projects" :query="{ where: { is_deleted: 0 } }"></Kpi>
          </div>
        </div>
        
       
      </div>
    </div>


  

  </div>
</section>
<?php $this->Html->script(['admin/vue-components/dashboard/Index.js?' . filemtime('js/admin/vue-components/dashboard/Index.js')], ['block' => 'vue-components']) ?>