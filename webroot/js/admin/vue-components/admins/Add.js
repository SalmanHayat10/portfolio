app.component('add-admin', {
    template: document.getElementById('add-admin').innerHTML,
    data() {
        return {
            btnLoading: false
        }
    },
    methods: {
        async onSubmit(data) {
            if (data.password != data.rpassword) {
                return showErrorMessage('Password are not matched.');
            }
            let media = {};
            if(data.media_id){
                media = await uploadMedia(data.media_id);
            }
            //getCount() - check username
            this.btnLoading = true;
            const resp = await saveData('Admins', {...data, media_id: _.get(media, 'id', null)});
            if (resp.success) {
                this.btnLoading = false;
                showSuccessMessage('Admin '+data.name +' added..');
                goTo('admins');
            }
        }
    },
    mounted() {
        console.log("Add Admin mounted.");
    }
});