<section class="content-header">
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
            <span class="text-uppercase page-subtitle"><?= getenv('APP_NAME') ? getenv('APP_NAME') : 'Dashboard' ?></span>
            <h3 class="page-title">Add Services</h3>
        </div>
        <div class="d-none d-sm-block offset-sm-4 col-4 col-12 col-sm-4 justify-content-end">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= $this->Url->build(["controller" => "Services", "action" => "index"]); ?>">Home</a></li>
                <li class="breadcrumb-item active">Services</li>
            </ol>
        </div>
    </div>
    <!-- End Page Header -->
</section>

<div>
    <add-services></add-services>
</div>

<section id="add-services" class="d-none">
    <div class="row">
        <div class="col-lg-6 col-sm-12 col-md-12">
            <div class="card card-small mb-4">
                <div class="card-body p-0 pb-3">
                    <div class="card-body d-flex flex-column">
                        <a-form @submit="onSubmit">
                            <div class="row">
                                <div class="col-12">
                                    <a-form-input type="text" name="title" label="Title" validation-name="Title" validation="required"></a-form-input>
                                </div>

                                <div class="col-6">
                                    <a-form-input type="text" name="title" label="Title" validation-name="Title"></a-form-input>
                                </div>
                                <div class="col-6">
                                    <a-form-input type="text" name="services_includes" label="Services Includes" validation-name="Services Includes"></a-form-input>
                                </div>
                                <div class="col-6">
                                    <a-form-input type="text" name="url_slug" label="Url slug" validation-name="Url slug"></a-form-input>
                                </div>
                                <div class="col-12">
                                    <label>Description</label>
                                    <div class="quill" name="long_description" style="height: 200px;max-height: 400px;overflow: auto;"></div>
                                </div>
                                 <div class="col-12">
                                    <a-form-input type="image" name="media_id" label="Select Your image to upload" validation="mime:image/jpeg,image/png" validation-name="Image"></a-form-input>
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

<?php $this->Html->script(['admin/vue-components/services/Add.js?' . filemtime('js/admin/vue-components/services/Add.js')], ['block' => 'vue-components']) ?>