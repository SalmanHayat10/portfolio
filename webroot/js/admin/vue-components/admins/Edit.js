app.component('edit-admin', {
    template: document.getElementById('edit-admin').innerHTML,
    data() {
        return {
            formData: {},
            formLoading: true,
            btnLoading: false
        }
    },
    methods: {
        async onSubmit(data) {
            console.log("Data",data);
            if (data.password && (data.password != data.rpassword)) {
                return showErrorMessage('Password are not matched.');
            }
            if (!data.password) {
                delete data.password;
            }
            this.btnLoading = true;
            let media = {};
            if(data.media_id){
                media = await uploadMedia(data.media_id);
                delete data.media_id;
                if (_.get(media, 'id', null)) {
                    media = {
                        media_id: media.id
                    }
                    delete data.media;
                }
            }
            const resp = await saveData('Admins', {id: getId(),...data, ...media});
            if (resp.success) {
                this.btnLoading = false;
                showSuccessMessage('Admin '+data.name+' Updated Successfully');
                goTo('admins');
            }
        },

        async getRecord() {
            try {
                const resp = await getOne('Admins', { 
                    where: {
                        'Admins.id': getId()
                    },
                    contain: ['Media']
                });
                if (resp.success) {
                    this.formData = resp.data;
                    delete this.formData.password;
                    if (_.get(resp, 'data.media.id', null)) {
                        this.formData.media_id = formatMedia(this.formData.media);
                    }
                    console.log("RespData",this.formData);
                    this.formLoading = false;
                }
            } catch (error) {
                console.log("ERR: ",error);
            }
        }
    },
    mounted() {
        this.getRecord();
    }
});