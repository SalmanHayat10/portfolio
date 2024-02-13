app.component('edit-blog', {
    template: document.getElementById('edit-blog').innerHTML,
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
            data.description = getContentHtml('quill');
            const resp = await saveData('Blogs', {id: getId(),...data, ...media});
            if (resp.success) {
                this.btnLoading = false;
                showSuccessMessage('Blog '+data.name+' Updated Successfully');
                goTo('blogs');
            }
        },

        async getRecord() {
            try {
                console.log("getRecord")
                const resp = await getOne('Blogs', { 
                    where: {
                        'Blogs.id': getId()
                    },
                    contain: ['Media']
                });
                console.log("resp", resp);
                if (resp.success) {
                    this.formData = resp.data;
                    delete this.formData.password;
                    setContentHtml('quill', this.formData.description, true);
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