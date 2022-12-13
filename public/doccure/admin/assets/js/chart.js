$(document).ready(function () {
    // Bar Chart

    Morris.Bar({
        element: "bar-charts",
        data: [
            { y: "2006", a: 100, b: 10, c: 70, d: 20 },
            { y: "2007", a: 75, b: 65, c: 90, d: 90 },
            { y: "2008", a: 50, b: 40, c: 90, d: 90 },
            { y: "2009", a: 75, b: 65, c: 90, d: 90 },
            { y: "2010", a: 50, b: 40, c: 90, d: 90 },
            { y: "2011", a: 75, b: 65, c: 90, d: 90 },
            { y: "2012", a: 100, c: 90, c: 90, d: 90 },
        ],
        xkey: "y",
        ykeys: ["a", "b", "c", "d"],
        labels: ["Total Sales", "Total Revenue", "Budget", "Loss"],
        // colors: ["red", "green", "blue", "orange"],
        // formatter: function (y, data) {return "$" + y;},
        // resize: true,
    });

    // Line Chart

    Morris.Area({
        element: "line-charts",
        data: [
            { y: "2006", a: 50, b: 90, c: 50, d: 10 },
            { y: "2007", a: 75, b: 65, c: 90, d: 90 },
            { y: "2008", a: 50, b: 40, c: 10, d: 20 },
            { y: "2009", a: 75, b: 65, c: 60, d: 70 },
            { y: "2010", a: 50, b: 40, c: 90, d: 10 },
            { y: "2011", a: 75, b: 65, c: 70, d: 90 },
            { y: "2012", a: 100, b: 50, c: 20, d: 30 },
        ],
        xkey: "y",
        ykeys: ["a", "b", "c", "d"],
        labels: ["Total Sales", "Total Revenue", "Budget", "Loss"],
        // lineColors: ["green", "red", "yellow", "blue"],
        lineWidth: "3px",
        resize: true,
        redraw: true,
    });
});
