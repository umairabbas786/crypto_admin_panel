<!-- body_script -->
<!-- jQuery 3 -->
<script src="backend/jquery/dist/jquery.min.js" type="text/javascript"></script>
<!-- jquery.validate -->
<script src="dist/js/jquery.validate.min.js" type="text/javascript"></script>
<!-- Bootstrap 3.3.7 -->
<script src="backend/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<!-- Select2 -->
<script src="backend/select2/select2.full.min.js" type="text/javascript"></script>
<!-- moment -->
<script src="backend/moment/moment.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js" type="text/javascript"></script>

<script>
	$(function () {
		$('input').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue',
			increaseArea: '20%' // optional
		});
	});

	$.validator.setDefaults({
		highlight: function (element) {
			$(element).parent('div').addClass('has-error');
		},
		unhighlight: function (element) {
			$(element).parent('div').removeClass('has-error');
		},
	});

	$('#admin_login_form').validate({
		errorClass: "has-error",
		rules: {
			email: {
				required: true,
				email: true,
			},
			password: {
				required: true
			}
		}
	});
</script>

<!-- ajaxSetup -->
<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-Token': $('meta[name=_token]').attr('content')
		}
	});
</script>

<script>
	function log(log) {
		console.log(log);
	}

	// delete script for href
	$(document).on('click', '.delete-warning', function (e) {
		e.preventDefault();
		var url = $(this).attr('href');
		$('#delete-modal-yes').attr('href', url);
		$('#delete-warning-modal').modal('show');
	});

	//delete script for buttons
	$('#confirmDelete').on('show.bs.modal', function (e) {
		$message = $(e.relatedTarget).attr('data-message');
		$(this).find('.modal-body p').text($message);
		$title = $(e.relatedTarget).attr('data-title');
		$(this).find('.modal-title').text($title);

		// Pass form reference to modal for submission on yes/ok
		var form = $(e.relatedTarget).closest('form');
		$(this).find('.modal-footer #confirm').data('form', form);
	});

	$('#confirmDelete').find('.modal-footer #confirm').on('click', function () {
		$(this).data('form').submit();
	});

	// language
	$('.lang').on('click', function () {
		var lang = $(this).attr('id');
		var url = "change-lang";
		var token = "hxU7GQmIVE8pnmrmEMPlgdVdvzCDtLrexjpl1w0f";

		console.log("on script file");
		$.ajax({
			url: url,
			// async : false,
			data: {
				// data that will be sent
				_token: token,
				lang: lang
			},
			// type of submision
			type: "POST",
			success: function (data) {
				console.log("sucess " + data);
				if (data == 1) {
					location.reload();
				}
			},
			error: function (xhr, desc, err) {
				return 0;
			}
		});
	});
</script>



<script src="backend/chart.js/Chart.min.js" type="text/javascript"></script>

<script>
	$(function () {
		'use strict';
		var areaChartData = {
			labels: jQuery.parseJSON(
				'["09 Jan","10 Jan","11 Jan","12 Jan","13 Jan","14 Jan","15 Jan","16 Jan","17 Jan","18 Jan","19 Jan","20 Jan","21 Jan","22 Jan","23 Jan","24 Jan","25 Jan","26 Jan","27 Jan","28 Jan","29 Jan","30 Jan","31 Jan","01 Feb","02 Feb","03 Feb","04 Feb","05 Feb","06 Feb","07 Feb","08 Feb"]'
			),
			datasets: [{
					label: "Deposit" + " " + "($)",
					// fillColor: "rgba(66,155,206, 1)",
					// strokeColor: "rgba(66,155,206, 1)",
					// pointColor: "rgba(66,155,206, 1)",

					fillColor: "#78BEE6",
					strokeColor: "#78BEE6",
					pointColor: "#78BEE6",

					pointStrokeColor: "#429BCE",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(66,155,206, 1)",
					data: ["167.90", "1300044.40", "212.40", "235.90", "0.00", "1050.00", "0.00",
						"101.30", "0.00", "1284.52", "988.00", "0.00", "59.00", "42.48", "23.60",
						"0.00", "200000.00", "82.60", "1000.00", "35.40", "500.00", "985.40", "29.50",
						"0.00", "1000000.00", "0.00", "611194.70", "0.00", "0.00", "2001000.00",
						"0.00"
					]
				},
				{
					label: "Payout" + " " + "($)",

					// fillColor: "rgba(255,105,84,1)",
					// strokeColor: "rgba(255,105,84,1)",
					// pointColor: "#F56954",

					fillColor: "#FBB246",
					strokeColor: "#FBB246",
					pointColor: "#FBB246",

					pointStrokeColor: "rgba(255,105,84,1)",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(255,105,84,1)",
					data: ["152.95", "0.00", "0.00", "92.00", "25.30", "149.50", "642.30", "185.15",
						"503830.25", "601.37", "499.10", "800.40", "103.50", "57.50", "47.15",
						"57.50", "0.00", "144.90", "46.00", "241.50", "195.50", "51.75", "0.00",
						"230.00", "29.90", "148.93", "59.80", "105.49", "547232.30", "1995127.65",
						"0.00"
					]
				},
				{
					label: "Transfer" + " " + "($)",

					// fillColor: "rgba(47, 182, 40,0.9)",
					// strokeColor: "rgba(47, 182, 40,0.8)",
					// pointColor: "#2FB628",

					fillColor: "#67FB4A",
					strokeColor: "#67FB4A",
					pointColor: "#67FB4A",

					pointStrokeColor: "rgba(47, 182, 40,1)",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(47, 182, 40,1)",
					data: ["597.22", "297.25", "98.46", "385.25", "196.12", "913.76", "1858.80",
						"1759.59", "1771.56", "1362.27", "4072.88", "29.80", "930.62", "6.03",
						"475.11", "425.58", "550150.31", "1412.94", "391515.28", "354.45", "454.47",
						"631.47", "663.09", "110119.27", "1050247.04", "903.13", "290.69", "95.99",
						"28038.56", "4527.23", "0.00"
					]
				}
			]
		};

		var areaChartOptions = {
			//Boolean - If we should show the scale at all
			showScale: true,
			//Boolean - Whether grid lines are shown across the chart
			scaleShowGridLines: false,
			//String - Colour of the grid lines
			scaleGridLineColor: "rgba(0,0,0,.05)",
			//Number - Width of the grid lines
			scaleGridLineWidth: 1,
			//Boolean - Whether to show horizontal lines (except X axis)
			scaleShowHorizontalLines: true,
			//Boolean - Whether to show vertical lines (except Y axis)
			scaleShowVerticalLines: true,
			//Boolean - Whether the line is curved between points
			bezierCurve: true,
			//Number - Tension of the bezier curve between points
			bezierCurveTension: 0.3,
			//Boolean - Whether to show a dot for each point
			pointDot: false,
			//Number - Radius of each point dot in pixels
			pointDotRadius: 4,
			//Number - Pixel width of point dot stroke
			pointDotStrokeWidth: 1,
			//Number - amount extra to add to the radius to cater for hit detection outside the drawn point
			pointHitDetectionRadius: 20,
			//Boolean - Whether to show a stroke for datasets
			datasetStroke: true,
			//Number - Pixel width of dataset stroke
			datasetStrokeWidth: 2,
			//Boolean - Whether to fill the dataset with a color
			datasetFill: true,
			//String - A legend template
			legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
			//Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
			maintainAspectRatio: true,
			//Boolean - whether to make the chart responsive to window resizing
			responsive: true
		};
		//-------------
		//- LINE CHART -
		//--------------
		var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
		var lineChart = new Chart(lineChartCanvas);
		var lineChartOptions = areaChartOptions;
		lineChartOptions.datasetFill = false;
		lineChart.Line(areaChartData, lineChartOptions);
	});
</script>

<!-- jquery.dataTables js -->
<script src="backend/DataTables_latest/DataTables-1.10.18/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="backend/DataTables_latest/Responsive-2.2.2/js/dataTables.responsive.min.js" type="text/javascript"></script>
<script src="backend/intl-tel-input-13.0.0/intl-tel-input-13.0.0/build/js/intlTelInput.js" type="text/javascript"></script>
<!-- isValidPhoneNumber -->
<script src="dist/js/isValidPhoneNumber.js" type="text/javascript"></script>
<script src="backend/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<!-- Lightbox -->
<script src="dist/js/lightbox.js" type="text/javascript"></script>

</body>

</html>