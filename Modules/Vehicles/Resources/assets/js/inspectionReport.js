import { Chart, registerables } from 'chart.js';

Chart.register(...registerables, );

import ChartDataLabels from 'chartjs-plugin-datalabels';

Chart.register(ChartDataLabels);
//Chart.register( c );
const colours = [
    "#2E2E6E",
    "#00C49A",
    "#F8E16C",
    "#FFC2B4",
    "#72839A",
    "#FB8F67",
    "#C1666B",
    "#157F1F",
    "#A0EADE",
];


/*
    By location
 */

let locationChartData = {
    labels: locationSummaryLabels,
    datasets: [
        {
            data: locationSummaryData,
            backgroundColor:  colours ,
        }
    ]
};



let locChart = new Chart(
    document.getElementById('byLocationChart'),
    {
        type: 'pie',
        data: locationChartData,
        options: {  },

    }
)


//         canvii[i].style.width = '6in';
//
// let byLocationChartBig = document.getElementById('byLocationChartBig');
//
//  let big = new Chart(
//     byLocationChartBig,
//     {
//         type: 'pie',
//         data: locationChartData,
//        options: {
//     plugins: {
//         datalabels: {
//             backgroundColor: function(context) {
//                 return context.dataset.backgroundColor;
//             },
//             borderColor: 'white',
//                 borderRadius: 25,
//                 borderWidth: 2,
//                 color: 'white',
//                 display: function(context) {
//                 var dataset = context.dataset;
//                 var count = dataset.data.length;
//                 var value = dataset.data[context.dataIndex];
//                 return value > count * 1.5;
//             },
//             font: {
//                 weight: 'bold'
//             },
//             padding: 6,
//                 formatter: Math.round
//         }
//     },
//
//     // Core options
//     aspectRatio: 4 / 3,
//         cutoutPercentage: 32,
//         layout: {
//         padding: 32
//     },
//     elements: {
//         line: {
//             fill: false
//         },
//         point: {
//             hoverRadius: 7,
//                 radius: 5
//         }
//     },
// },
//
//
//     }
// )
// byLocationChartBig.style.maxWidth = '7in';
// byLocationChartBig.style.maxHeight = '7in';
// big.update();
//


new Chart(
    document.getElementById('bySourceChart'),
    {
        type: 'pie',
        data: {
            labels: sourcesLabels,
            datasets: [
                {
                    data: sourcesData,
                    backgroundColor:  colours ,
                }
            ]
        },
        options: {

        }
    }
)


new Chart(
    document.getElementById('bySeverityChart'),
    {
        type: 'pie',
        data: {
            labels: severityLabels,
            datasets: [
                {
                    data: severityData,
                    backgroundColor:  colours ,
                }
            ]
        },
        options: {}
    }
)

new Chart(
    document.getElementById('byTypeChart'),
    {
        type: 'pie',
        data: {
            labels: typesLabels,
            datasets: [
                {
                    data: typesData,
                    backgroundColor:  colours ,
                }
            ]
        },
        options: {}
    }
)


// window.addEventListener('beforeprint', function() {
//     console.log('printing...');
//     let canvii = document.getElementsByClassName('piechart');
//     for (let i = 0; i < canvii.length; i++)
//     {
//         canvii[i].style.width = '6in';
//         canvii[i].style.height = '6in';
//
//     }
//     // document.getElementById('byLocationChart').style.width = '7in';
//     // document.getElementById('byLocationChart').style.height = '7in';
//     locChart.update();
// });
