app.component("dashboard", {
    template: document.getElementById("dashboard").innerHTML,
    data() {
        return {};
    },

    async mounted() {
        console.log("Dashboard Mounted!");
    },
});
