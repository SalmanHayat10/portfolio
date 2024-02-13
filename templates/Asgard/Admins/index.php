<section class="content" id="admin-datatable">
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Admins</h3>
        </div>
    </div>

    <div>
        <data-table 
            model="Admins"
            :query="{
                where:{
                    'Admins.is_deleted': 0,
                }
            }"
            :has-checkbox="true" 
            :header-actions="[{
                icon: 'add',
                text: 'Add Admin',
                class: 'btn-accent fab-btn',
                url: '<?= $this->Url->build(["controller" => "Admins", "action" => "add"]); ?>'
            }]"
            :headers="
            [
                {
                    text: 'Name',
                    field: 'name',
                    isAction: true,
                    isEditable: true
                },
                {
                    text: 'Username',
                    field: 'username'
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
                    isAction: true,
                },
                {
                    text: 'Actions',
                    editUrl: ({ id }) => `admins/edit/${id}`,
                    isAction: true,
                    isDelete: true
                }
            ]
            "
        >
        </data-table>
    </div>

</section>