
<div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
    <span class="text-uppercase page-subtitle">Salman PortFolio</span>
    <h3 class="page-title">Abouts</h3>
    </div>
</div>
<div>
    <data-table 
        ref="datatable"
        model="Abouts"
        :loading="loading"
        :query="{
            where:{
                'Abouts.is_deleted': 0,
            },
            contain: ['Media']


        }"
        :search="[
            {
               
            }
        ]"
        :header-actions="[{ 
            icon: 'add',
            text: 'Add Abouts',
            class: 'btn-accent fab-btn',
            url: '<?= $this->Url->build(["controller" => "Abouts", "action" => "add"]); ?>'
        }]"
         :headers="
        [
            
            {
                text: '#',  
                displayAs: ({ media }) => media && media.value ? `<img src='<?=$this->request->getAttribute('webroot')?>${media.directory}${media.value}' style='height:50px;width:55px;border-radius:10px;object-fit:contain;'/>`:`<img src='<?=$this->request->getAttribute('webroot')?>img/no-image.png' style='height:50px;width:55px;border-radius:10px;'/>`

            },
            
           
            {
                text: 'Short Title',
                field: 'short_title',
            },
            {
                text: 'Birthdate',
                field: 'birthdate',
            },
            {
                text: 'Phone',
                field: 'phone',
            },
            {
                text: 'City',
                field: 'city',
            },
            {
                text: 'Age',
                field: 'age',
            },
            {
                text: 'Degree',
                field: 'degree',
            },
            {
                text: 'Email',
                field: 'email',
            },
             {
                text: 'is Featured?',
                field: 'is_featured',
                isAction: true,
                isToggle: true
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
                editUrl: ({ id }) => `abouts    /edit/${id}`,
                isAction: true,
                isDelete: true
            }
        ]
        "
    >
    </data-table>  
</div>