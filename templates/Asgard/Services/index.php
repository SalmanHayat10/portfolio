
<div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
    <span class="text-uppercase page-subtitle">Make-Well</span>
    <h3 class="page-title">Services</h3>
    </div>
</div>
<div>
    <data-table 
        ref="datatable"
        model="Services"
        :loading="loading"
        :query="{
            where:{
                'Services.is_deleted': 0,
            },
            contain: ['Media']
            
        }"
        :search="[
            {
                field: 'Services.title',
                text: 'Title'
            }
        ]"
        :header-actions="[{ 
            icon: 'add',
            text: 'Add Services',
            class: 'btn-accent fab-btn',
            url: '<?= $this->Url->build(["controller" => "Services", "action" => "add"]); ?>'
        }]"
         :headers="
        [
            {
                text: '#',
                displayAs: ({ media }) => media && media.value ? `<img src='${BASE_IMAGE_URL}${media.value}' class='avatar-thumbnail'/>`:`<img  class='avatar-thumbnail' src='<?= $this->request->getAttribute('webroot')?>img/default_cover.png'/>`
            },
            {
                text: 'Title',
                field: 'title',
            },
            {
                text: 'Short_Description',
                field: 'short_description',
            },
            {
                text: 'Short Title',
                field: 'short_title',
            },
            {
                text: 'Services Includes',
                field: 'services_includes',
            },
            {
                text: 'Url slug',
                field: 'url_slug',
            },
            {
                text: 'is Active?',
                field: 'is_active',
                isAction: true,
                isToggle: true
            },
            {
                text: 'Updated At',
                field: 'updated_at',
                dateFormat: 'Do MMM YYYY hh:mm A'
            },
            {
                text: 'Actions',
                editUrl: ({ id }) => `services/edit/${id}`,
                isAction: true,
                isDelete: true
            }
        ]
        "
    >
    </data-table>  
</div>