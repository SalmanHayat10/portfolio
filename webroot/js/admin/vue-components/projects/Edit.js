app.component('edit-projects', {
    template: document.getElementById('edit-projects').innerHTML,
    data() {
        return {
            formData: {},
            formLoading: true,
            btnLoading: false
        }
    },
    methods: {
        async onSubmit(data) {
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
            const resp = await saveData('Projects', {id: getId(),...data, ...media});
            if (resp.success) {
                this.btnLoading = false;
                showSuccessMessage('Projects '+data.name+' Updated Successfully');
                goTo('Projects');
            }
        },

        async getRecord() {
            try {
                console.log("getRecord")
                const resp = await getOne('Projects', { 
                    where: {
                        'Projects.id': getId()
                    },
                    contain: ['Media']
                });
                console.log("resp", resp);
                if (resp.success) {
                    this.formData = resp.data;
                    delete this.formData.password;
                    if (_.get(resp, 'data.media.id', null)) {
                        this.formData.media_id = formatMedia(this.formData.media);
                    }
                    console.log("RespData", this.formData);
                    this.formLoading = false;
                }
            } catch (error) {
                console.log("ERR: ",error);
            }
        }
    },
    async mounted() {
        await this.getRecord();
    }
});