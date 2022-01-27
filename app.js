var rootURL = "https://smartenv.salviano.xyz";
var dashboardApp = new Vue({

    el: '#SEDashboard',

    data: {
        level1: 'XX',
        level2: 'XX',
        level3: 'XX'
    },

    methods: {

        refreshItems: function (instant) {
            task = "/get.php";
            if (instant) task = "/get.php?instant=1";
            axios.get(rootURL + task)
                .then(response => {
                    //this.level = JSON.parse(response.data);
                    this.level1 = response.data['sensor_value_1'];
                    this.level2 = response.data['sensor_value_2'];
                    this.level3 = response.data['sensor_value_3'];
                    
                    console.log(this.level);
                    this.refreshItems();
                })
        },

    },

    mounted() {
        this.refreshItems(true);
    }
});
