<section class="content" id="admin-datatable">
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Projects</h3>
        </div>
    </div>

    <div>
        <data-table 
            model="Projects"
            :query="{
                where:{
                    'Projects.is_deleted': 0,
                },
                contain: ['Media']
            }"
            :header-actions="[{
                icon: 'add',
                text: 'Add Projects ',
                class: 'btn-accent fab-btn',
                url: '<?= $this->Url->build(["controller" => "Projects", "action" => "add"]); ?>'
            }]"
            :headers="
            [
                {
                    text: '#',
                    displayAs: ({ media }) => media && media.value ? `<img src='<?=$this->request->getAttribute('webroot')?>${media.directory}${media.value}' style='height:50px;width:55px;border-radius:10px;object-fit:contain;'/>`:`<img src='<?=$this->request->getAttribute('webroot')?>img/no-image.png' style='height:50px;width:55px;border-radius:10px;'/>`
                },
                {
                    text: 'Title',
                    field: 'title',
                    isAction: true,
                    isEditable: true
                },
                {
                    text: 'isFeatured?',
                    field: 'is_featured',
                    isAction: true,
                    isToggle: true
                },
                {
                    text: 'isActive?',
                    field: 'is_active',
                    isAction: true,
                    isToggle: true
                },
                {
                    text: 'Updated At',
                    field: 'updated_at',
                    dateFormat: 'Do MMM YYYY hh:mm A',
                    type: 'datetime',
                    sort: true
                },
                {
                    text: 'Actions',
                    editUrl: ({ id }) => `projects/edit/${id}`,
                    isAction: true,
                    isDelete: true
                }
            ]
            "
        >
        </data-table>
    </div>

</section>