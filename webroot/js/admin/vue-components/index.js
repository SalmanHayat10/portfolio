console.log("VueJS - Loaded.");

//Default constants variables.
const BASE_URL = document.getElementById('base-url') ? document.getElementById('base-url').value : null;
const API_URL = BASE_URL + 'api/' ;
const BASE_IMAGE_URL = document.getElementById('base-image-url') ? document.getElementById('base-image-url').value : null;
const WEBROOT = document.getElementById('webroot') ? document.getElementById('webroot').value : null;
const FULL_URL = document.getElementById('full-url') ? document.getElementById('full-url').value : null;
// ----------------------

//Mixings
const vueMixings = {
    data() {
        return {
            BASE_IMAGE_URL: BASE_IMAGE_URL
        }
    },
    methods: {
        async fetchQuery(modelName, query, conditions = {}) {
            try {
                const list = [];
                let where = {};
                if (query) {
                    if (!conditions) {
                        where = {
                            'name LIKE': '%' + query + '%',
                            is_active: 1,
                            is_deleted: 0
                        }
                    }
                }
                const resp = await getList(modelName, {
                    where: {
                        is_active: 1,
                        is_deleted: 0,
                        ...where,
                        ...conditions,
                    },
                    limit: 50
                });
                if (resp.success) {
                    resp.data.map((item) => {
                        list.push({ value: item.id, label: item.name, data: item });
                    });
                }
                console.log(modelName, "List: ", list);
                return list;
            } catch (error) {
                console.log("ERR: ", error)
            }
        }
    },
}

//Global Vue App
const VueApp = {
    data() {
        return {
            name: 'Mohammed Sufyan',
            formValues: {},
            couponType: 'Percent'
        }
    },
    methods: {
        onSubmit(values) {
            console.log("Form Values: ", values);
        },
        async fetchAdmins(query) {
            console.log("[!] Query: ", query);
            const list = [];
            let where = {};
            if (query) {
                where = {
                    'name LIKE': '%' + query + '%'
                }
            }
            const resp = await getList('Admins', { 
                where: { 
                    ...where
                },
                limit: 3,
                select: ['id','name']
            });
            if (resp.success) {
                resp.data.map((item) => {
                    list.push({ value: item.id, label: item.name });
                });
            }
            return list;
        }
    },
    mounted() {
        console.log("VueApp Loaded.");
    }
};
const app = Vue.createApp(VueApp);

//Adding Libs Globally accessible
app.config.globalProperties.moment=moment;

//Mixings
app.mixin(vueMixings);
// Default Components
if (VueformMultiselect) {
    app.component('Multiselect', VueformMultiselect);
}