<!doctype html>
<html class="no-js h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login - <?= env('APP_NAME')?></title>
    <meta name="description" content="Ascendtis IT Solutions LLP">
    <meta name="author" content="Ascendtis IT Solutions LLP">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lobster+Two&display=swap" rel="stylesheet">

    <!-- Font Awesome Start -->
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Font Awesome End -->

    <!-- Material Icon Start -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Material Icon End -->

    <!-- Tamplate CSS Start-->
    <?= $this->Html->css(['admin/bootstrap.min', 'flash', 'admin/login']) ?>
</head>

<body>
    <?= $this->Flash->render() ?>
    <div class="row row-no-margin" style="height:100vh;">
        <div class="col-lg-6 col-md-6 col-xs-12 d-flex justify-content-center align-items-center login-background-color view-desktop-only"
            style="height:100%;">
            <div class="heading-font">
                Asgard v5
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-xs-12 d-flex justify-content-center align-items-center">
            <?= $this->fetch('content') ?>
        </div>
    </div>

    <?= $this->Html->script(['admin/jquery-3.3.1.min',
                         'admin/bootstrap.min',
                         'admin/jquery.sharrre.min',
                         ])?>

    <script>
    setTimeout(function() {
        $('.flash-message').fadeOut(3000);
    }, 0);
    </script>
</body>
</html>
