app.component('add-blog', {
    template: document.getElementById('add-blog').innerHTML,
    data() {
        return {
            btnLoading: false
        }
    },
    methods: {
        async onSubmit(data) {
            data.description = getContentHtml('quill');
            
            let media = {};
            if(data.media_id){
                media = await uploadMedia(data.media_id);
            }
            this.btnLoading = true;
            const resp = await saveData('Blogs', {...data, media_id: _.get(media, 'id', null) });
            if (resp.success) {
                this.btnLoading = false;
                showSuccessMessage('Blog '+data.name +' added..');
                goTo('Blogs');
            }
        }
    },
    mounted() {
        console.log("Add Blog mounted.");
    }
});


