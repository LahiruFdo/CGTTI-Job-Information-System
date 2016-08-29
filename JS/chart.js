//function getchart(d1,d2,d3,d4,d5,d6){
	var colors = ["#5DA5DA","#F15854","#DECF3F","#B276B2","#FAA43A","#4D4D4D"];
	var data = new Array (10,10,20,30,10,20);

	function getTotal(){
		var total = 0;
		for (var j = 0; j < data.length; j++) {
			total += (typeof data[j] == 'number') ? data[j] : 0;
		}
		return total;
	}

	function addData() {
		var canvas;
		var contex;
		var lastValue = 0;
		var total = total();

		canvas = document.getElementById("chart");
		contex = canvas.getContext("2d");
		contex.clearRect(0, 0, canvas.width, canvas.height);

		for (var i = 0; i < data.length; i++) {
			contex.fillStyle = colors[i];
			contex.beginPath();
			contex.moveTo(200,150);
			contex.arc(200,150,150,lastValue,lastValue+(Math.PI*2*(data[i]/total)),false);
			contex.lineTo(200,150);
			contex.fill();
			lastValue += Math.PI*2*(data[i]/total);
		}
	}

	addData();
//}