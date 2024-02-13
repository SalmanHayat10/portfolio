<section class="content" id="admin-datatable">
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Dashboard</span>
        <h3 class="page-title">Admins</h3>
        </div>
    </div>

    <div>
        <!-- Admin DataTable! <span :bind="name"></span>{{name}}
        <todo-item></todo-item> -->
        <data-table 
            model="Admins"
            :query="{
                where:{
                    is_deleted: 0
                }
            }"
            :has-checkbox="true"
            :is-expand="true"
            :single-expand="true"
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
                    text: 'LastLoginAt',
                    field: 'updated_at',
                    dateFormat: 'Do MMM YYYY hh:mm A',
                    type: 'datetime',
                    isAction: true,
                    isEditable: true
                },
                {
                    text: 'CustomActions',
                    isAction: true,
                    actions: [
                        {
                            text: 'test',
                            icon: 'home'
                        },
                        {
                            text: 'ziya',
                            icon: 'info'
                        }
                    ]
                },
                {
                    text: 'Actions',
                    isAction: true,
                    isDelete: true
                }
            ]
            "
        >

        <template v-slot:expand="{ item }">
            <div class="row m-0">
                <div class="col">
                    <data-table 
                        model="Admins"
                        :query="{
                            where: {
                                id: item.id
                            }
                        }"
                        :headers="[
                            {
                                text: 'Name',
                                field: 'name'
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
                            }
                        ]"
                    ></data-table>
                </div>
            </div>
        </template>

        </data-table>
    </div>
</section>

<!-- Scripts -->
<?php $this->Html->script(['admin/vue-components/admins/AddAdmin.js?' . filemtime('js/admin/vue-components/admins/AddAdmin.js')], ['block' => 'vue-components']) ?>
