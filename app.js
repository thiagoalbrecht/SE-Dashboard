var rootURL = "https://smartenv.salviano.xyz";
var controller = new AbortController();
var doingRequest = false;
var dashboardApp = new Vue({

    el: '#SEDashboard',

    data: {
        level1: '0',
        level2: '0',
        level3: '0',
        lastdate: '00-00-0000 00:00:00',
        liveUpdate: true
    },

    methods: {

        refreshItems: function (instant, repeat) {
            task = "/get.php";
            if (instant) task = "/get.php?instant=1";
            if (!doingRequest) {
                doingRequest = true;
                axios.get(rootURL + task)
                    .then(response => {
                        doingRequest = false;
                        this.level1 = response.data['sensor_value_1'];
                        this.level2 = response.data['sensor_value_2'];
                        this.level3 = response.data['sensor_value_3'];
                        this.lastdate = response.data['datetime'];
                        if (this.liveUpdate && repeat) {
                            this.refreshItems(false, true);
                        }
                    }).catch(err => {
                        doingRequest = false;
                        console.log(err);
                    });
            }

        },

    },

    mounted() {
        this.refreshItems(true, true);
    }
});
