<!doctype html>
<html class="no-js h-100" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Shards Dashboard Lite - Free Bootstrap Admin Template – DesignRevision</title>
  <meta name="description" content="A high-quality &amp; free Bootstrap admin dashboard template pack that comes with lots of templates and components.">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <?= $this->Html->css(['admin/shards-dashboards.1.1.0.min',  'admin/extras.1.1.0.min']) ?>

  <!-- Vue Components CSS -->
  <?= $this->Html->css(['vue/datatable.css?' . filemtime('css/vue/datatable.css')]) ?>
  <?= $this->Html->css(['vue/sidebar.css?' . filemtime('css/vue/sidebar.css')]) ?>
  <?= $this->Html->css(['admin/style.css?' . filemtime('css/admin/style.css')]) ?>
  <?= $this->Html->css(['vue/multiselect']) ?>
  <!-- common -->
  <?= $this->Html->css(['flash']) ?>

    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <!-- Include the Quill library -->
  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

  <?= $this->Html->css(['vue/form-inputs.css?' . filemtime('css/vue/form-inputs.css')]) ?>
  <!-- \ Ends Here -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</head>

<body class="h-100">

  <div id="vue-app" class="container-fluid m-0">
    <div class="row">
    <?= $this->element('admin/sidebar') ?>
      <!-- sidebar -->
      <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <div class="main-navbar sticky-top bg-white">
          <?= $this->element('admin/navbar') ?>
          <div id="flash-container">
            <?= $this->Flash->render() ?>
          </div>
          <div class="container-fluid">
            <?= $this->fetch('content') ?>
          </div>
        </div>
      </main>
    </div>
  </div>

  <!-- logout Model start here -->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?= $this->Url->build(["controller" => "Admins", "action" => "logout"]); ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <!-- logout Model End here -->

  <!-- Constants -->
  <div>
    <input type="hidden" id="base-url" value="<?= $this->Url->build('/', ['escape' => false, 'fullBase' => true]); ?>" />
    <input type="hidden" id="base-image-url" value="<?= $this->request->getAttribute('webroot') ?>files/Media/value/" />
    <input type="hidden" id="access_token" value="<?= isset($ACCESS_TOKEN) ? $ACCESS_TOKEN : '' ?>" />
    <input type="hidden" id="webroot" value="<?= $this->request->getAttribute('webroot') ?>" />
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
  <script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>

  <?= $this->Html->script(['admin/extras.1.1.0.min', 'admin/shards-dashboards.1.1.0.min']) ?>

  <!-- Other Important Libraries -->
  <?= $this->Html->script(['axios.min', 'lodash.min', 'moment.min', 'lib/flash', 'lib/index.js?' . filemtime('js/lib/index.js'), 'lib/query.js?' . filemtime('js/lib/query.js')]) ?>
  <!-- \ Ended Other Libraries -->

  <!-- Vue Components -->
  <div style="display: none;">
    <?= $this->element('vue-components/datatable') ?>
    <?= $this->element('vue-components/sidebar') ?>
    <?= $this->element('vue-components/form-input') ?>
  </div>
  <!-- \ Vue Ends Here -->

  <!-- VueJS Lib -->
  <?php if (env('DEBUG') == 'false') : ?>
    <!-- Production -->
    <?= $this->Html->script(['vue/vue.global.prod']) ?>
  <?php else : ?>
    <?= $this->Html->script(['vue/vue.global']) ?>
    <!-- Development -->
  <?php endif; ?>
  <!-- ********* -->
  
  <!-- Dependencies -->
  <?= $this->Html->script(['lib/multiselect/multiselect.global']) ?>
  <!-- \ End of Dependencies -->

  <!-- Main VueApp -->
  <?= $this->Html->script(['admin/vue-components/index.js?' . filemtime('js/admin/vue-components/index.js')]) ?>
  <?= $this->Html->script(['lib/media']) ?>


  <!-- Shared Components -->
  <?= $this->Html->script(['admin/vue-components/shared/DataTable.js?' . filemtime('js/admin/vue-components/shared/DataTable.js')]) ?>
  <?= $this->Html->script(['admin/vue-components/shared/Sidebar.js?' . filemtime('js/admin/vue-components/shared/Sidebar.js')]) ?>
  <?= $this->Html->script(['admin/vue-components/shared/form/AForm.js?' . filemtime('js/admin/vue-components/shared/form/AForm.js')]) ?>
  <?= $this->Html->script(['admin/vue-components/shared/form/AFormInput.js?' . filemtime('js/admin/vue-components/shared/form/AFormInput.js')]) ?>

  <?= $this->Html->script(['admin/vue-components/shared/Kpi.js?' . filemtime('js/admin/vue-components/shared/Kpi.js')]) ?>


  <!-- Each Page Components -->
  <?= $this->fetch('vue-components'); ?>

  <script>
    app.mount('#vue-app');
    console.log("App mounted");
    const quillOptions = {
      modules: {
      toolbar: [
        ['bold', 'italic', 'underline', 'strike'],
        ['link', 'blockquote', 'code-block'], //, 'image'
        [{ list: 'ordered' }, { list: 'bullet' }],
        [{ 'header': [1, 2, 3, 4, false] }],
        [{ 'align': [] }],   [{ 'font': [] }],
        [{ 'color': [] }, { 'background': [] }],
      ]
      },
      theme: 'snow'
    }
    const elements = document.getElementsByClassName('quill');
    if (elements?.length > 0) {
      new Quill('.quill', quillOptions);    
    }
  </script>
</body>

</html>