// Based on the tutorial code provided by ApexCharts' documentation: https://apexcharts.com/javascript-chart-demos/line-charts/realtime/

var lastDate = 0;
var sensor1data = [];
var sensor2data = [];
var sensor3data = [];
var datetime = [];
function getNewSeries() {
    for (var i = 0; i <= sensor1data.length - 20; i++) {
        sensor1data.shift();
        sensor2data.shift();
        sensor3data.shift();
        datetime.shift();

    }
    sensor1data.push(dashboardApp.level1);
    sensor2data.push(dashboardApp.level2);
    sensor3data.push(dashboardApp.level3);
    datetime.push(dashboardApp.lastdate.substring(11));
}

var options = {
    series: [{
        name: "Sensor 1",
        data: sensor1data
    },
    {
        name: "Sensor 2",
        data: sensor2data
    },
    {
        name: "Sensor 3",
        data: sensor3data
    }],
    chart: {
        id: 'realtime',
        height: 350,
        type: 'line',
        animations: {
            enabled: false
        },
        toolbar: {
            show: false
        },
        zoom: {
            enabled: false
        }
    },
    xaxis: {
        type: 'category',
        categories: datetime
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        curve: 'smooth'
    },
    title: {
        text: 'Sensor values',
        align: 'left'
    },
    markers: {
        size: 0
    },
    yaxis: {
        min: 0,
        max: 100
    },
    legend: {
        show: true
    },
};

function refreshChart() {

    chart.updateOptions({
        xaxis: {
            type: 'category',
            categories: datetime
        }
    })
    getNewSeries()

    chart.updateSeries([{
        name: "Sensor 1",
        data: sensor1data
    },
    {
        name: "Sensor 2",
        data: sensor2data
    },
    {
        name: "Sensor 3",
        data: sensor3data
    },
    ])
}

var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();

function forceUpdateRender() {
    setTimeout(function () {
        chart.windowResizeHandler();
    }, 100);

}