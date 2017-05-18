var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "Werkzaamheden"
	},
	axisX: {
		interval: 10
	},
	data: [{
		type: "line",
		dataPoints: [
		  { x: 10, y: 45 },
		  { x: 20, y: 14 },
		  { x: 30, y: 20 },
		  { x: 40, y: 60 },
		  { x: 50, y: 50 },
		  { x: 60, y: 80 },
		  { x: 70, y: 40 },
		  { x: 80, y: 60 },
		  { x: 90, y: 10 },
		  { x: 100, y: 50 },
		  { x: 110, y: 40 },
		  { x: 120, y: 14 },
		  { x: 130, y: 70 },
		  { x: 140, y: 40 },
		  { x: 150, y: 90 },
		]
	}]
});
chart.render();

var chart = new CanvasJS.Chart("chartContainer2", {
	title: {
		text: "Winsten"
	},
	theme: "theme2",
	animationEnabled: true,
	axisX: {
		valueFormatString: "MMM"
	},
	axisY: {
		valueFormatString: "#0$"
	},
	data: [{
		type: "line",
		dataPoints: [
		{ x: new Date(2012, 01, 1), y: 71, indexLabel: "gain", markerType: "triangle", markerColor: "#6B8E23", markerSize: 12 },
		{ x: new Date(2012, 02, 1), y: 55, indexLabel: "loss", markerType: "cross", markerColor: "tomato", markerSize: 12 },
		{ x: new Date(2012, 03, 1), y: 50, indexLabel: "loss", markerType: "cross", markerColor: "tomato", markerSize: 12 },
		{ x: new Date(2012, 04, 1), y: 65, indexLabel: "gain", markerType: "triangle", markerColor: "#6B8E23", markerSize: 12 },
		{ x: new Date(2012, 05, 1), y: 85, indexLabel: "gain", markerType: "triangle", markerColor: "#6B8E23", markerSize: 12 },
		{ x: new Date(2012, 06, 1), y: 68, indexLabel: "loss", markerType: "cross", markerColor: "tomato", markerSize: 12 },
		{ x: new Date(2012, 07, 1), y: 28, indexLabel: "loss", markerType: "cross", markerColor: "tomato", markerSize: 12 },
		{ x: new Date(2012, 08, 1), y: 34, indexLabel: "gain", markerType: "triangle", markerColor: "#6B8E23", markerSize: 12 },
		{ x: new Date(2012, 09, 1), y: 24, indexLabel: "loss", markerType: "cross", markerColor: "tomato", markerSize: 12 }
		]
	}
	]
});

chart.render();