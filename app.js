var dashboardApp = new Vue({

	el: '#SEDashboard',

	data: {
		level: [0,0,0]
	},

	methods: {

		refreshItems: function () {

		},

	},

	mounted() {
		this.refreshItems(true);
	}
});
