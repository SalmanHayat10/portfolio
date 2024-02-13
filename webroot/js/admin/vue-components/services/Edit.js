app.component('edit-services', {
    template: document.getElementById('edit-services').innerHTML,
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
            if (data.media_id) {
                media = await uploadMedia(data.media_id);
                delete data.media_id;
                if (_.get(media, 'id', null)) {
                    media = {
                        media_id: media.id
                    }
                    delete data.media;
                }
            }
            data.long_description = getContentHtml('quill');

            const resp = await saveData('Services', { id: getId(), ...data, ...media });
            if (resp.success) {
                this.btnLoading = false;
                showSuccessMessage('Story updated successfully');
                goTo('services');
            }
        },

        async getRecord() {
            try {
                const resp = await getOne('Services', {
                    where: {
                        'Services.id': getId()
                    },
                    contain: ['Media']
                });
                if (resp.success) {
                    this.formData = resp.data;
                    setContentHtml('quill',  resp.data.long_description, true);
                    if (_.get(resp, 'data.media.id', null)) {
                        this.formData.media_id = formatMedia(this.formData.media);
                        console.log("media_id", this.formData.media_id)
                    }
                    this.formLoading = false;
                }
            } catch (error) {
                console.log("ERR: ", error);
            }
        }
    },
    mounted() {
        this.getRecord();
    }
});
