
<div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
    <span class="text-uppercase page-subtitle">Make-Well</span>
    <h3 class="page-title">Reviews</h3>
    </div>
</div>
<div>
    <data-table 
        ref="datatable"
        model="Reviews"
        :loading="loading"
        :query="{
            where:{
                'Reviews.is_deleted': 0,
            },

        }"
        :search="[
            {
                text: '	Customers Name',
                field: 'customers_name',
            }
        ]"
        :header-actions="[{ 
            icon: 'add',
            text: 'Add Reviews',
            class: 'btn-accent fab-btn',
            url: '<?= $this->Url->build(["controller" => "Reviews", "action" => "add"]); ?>'
        }]"
         :headers="
        [
            
          
            {
                text: '	Customers Name',
                field: 'customers_name',
            },
            {
                text: 'Description',
                field: 'description',
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
                editUrl: ({ id }) => `reviews/edit/${id}`,
                isAction: true,
                isDelete: true
            }
        ]
        "
    >
    </data-table>  
</div>