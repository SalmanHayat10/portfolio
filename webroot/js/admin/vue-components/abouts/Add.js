app.component('add-abouts', {
    template: document.getElementById('add-abouts').innerHTML,
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
            this.btnLoading = true;
            const resp = await saveData('Abouts', {...data, media_id: _.get(media, 'id', null) });
            if (resp.success) {
                this.btnLoading = false;
                showSuccessMessage('abouts added.');
                goTo('abouts');
            }
        },
    },
    mounted() {}
});