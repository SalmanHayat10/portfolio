app.component('add-services', {
    template: document.getElementById('add-services').innerHTML,
    data() {
        return {
            btnLoading: false
        }
    },
    methods: {
        async onSubmit(data) {
            let media = {};
            if (data.media_id) {
                media = await uploadMedia(data.media_id);
            }
            data.long_description = getContentHtml('quill');
            this.btnLoading = true;
            const resp = await saveData('Services', {...data, media_id: _.get(media, 'id', null) });
            if (resp.success) {
                this.btnLoading = false;
                showSuccessMessage('Services added.');
                goTo('services');
            }
        },
    },
    mounted() {}
});