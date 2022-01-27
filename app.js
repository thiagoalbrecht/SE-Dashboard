var rootURL = "https://smartenv.salviano.xyz";
var dashboardApp = new Vue({

    el: '#SEDashboard',

    data: {
        level: []
    },

    methods: {

        refreshItems: function (instant) {
            task = "/get.php";
            if (instant) task = "/get.php?instant=1";
            axios.get(rootURL + task)
                .then(response => {
                    //this.level = JSON.parse(response.data);
                    this.level[0] = response.data['sensor_value_1'];
                    this.level[1] = response.data['sensor_value_2'];
                    this.level[2] = response.data['sensor_value_3'];
                    
                    console.log(this.level);
                    this.refreshItems();
                })
        },

    },

    mounted() {
        this.refreshItems(true);
    }
});
