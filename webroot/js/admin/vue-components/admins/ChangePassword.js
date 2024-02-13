app.component('change-password', {
    template: document.getElementById('change-password').innerHTML,
    data() {
        return {}
    },
    methods: {
        async onSubmit(data) {
            if (data.password != data.rpassword) {
                return showErrorMessage('Password are not matched.');
            }
            const resp = await saveData('Admins', {id: USER.id, password: data.password });
            if (resp.success) {
                showSuccessMessage('Password Changed Succesfully...');
                goTo('admins');
            }
        }
    },
    mounted() {
        console.log("Change Password mounted.");
    }
});