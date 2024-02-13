<section class="content-header">
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
            <span class="text-uppercase page-subtitle"><?= getenv('APP_NAME') ? getenv('APP_NAME') : 'Dashboard' ?></span>
            <h3 class="page-title">Edit Reviews</h3>
        </div>
        <div class="d-none d-sm-block offset-sm-4 col-4 col-12 col-sm-4 justify-content-end">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= $this->Url->build(["controller" => "Reviews", "action" => "index"]); ?>">Home</a></li>
                <li class="breadcrumb-item active">Reviews</li>
            </ol>
        </div>
    </div>
    <!-- End Page Header -->
</section>

<div>
    <edit-reviews></edit-reviews>
</div>

<section id="edit-reviews" class="d-none">
    <div class="row">
        <div class="col-lg-6 col-sm-12 col-md-12">
            <div class="card card-small mb-4">
                <div class="card-body p-0 pb-3">
                    <div class="card-body d-flex flex-column">
                        <a-form :values="formData" @submit="onSubmit" :loading="formLoading">
                            <div class="row">
                             
                                <div class="col-12">
                                    <a-form-input type="text" name="customers_name" label="Customers Name" validation-name=" name" validation="required"></a-form-input>
                                </div>
                                <div class="col-12">
                                    <a-form-input type="textarea" name="description" label="Description" validation-name=" Description" validation="required"></a-form-input>
                                </div>

                            </div>

                            <div class="row pt-3">
                                <div class="col-12">
                                    <div class="form-group mb-0 float-right">
                                        <a-form-input type="submit" :loading="btnLoading" label="Submit">
                                        </a-form-input>
                                    </div>
                                </div>
                            </div>
                        </a-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->Html->script(['admin/vue-components/reviews/Edit.js?' . filemtime('js/admin/vue-components/reviews/Edit.js')], ['block' => 'vue-components']) ?>