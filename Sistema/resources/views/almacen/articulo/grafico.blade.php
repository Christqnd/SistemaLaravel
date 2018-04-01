<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<style media="screen">
	@media print {
		@page {
			size: 30mm 21mm;
			margin: 0;
			padding: 0;
		}
		html, body {
			position: relative;
			width: 100%;
			height: 100%;
			max-width: 100%;
			max-height: 97%;
			margin: 0;
			padding: 0;
		}
		svg {
			width: 100%;
			height: 100%;
			max-width: 100%;
			max-height: 100%;
		}
	}
	</style>
	<script type="text/javascript">

	.controller('MyCtrl', function($scope,$timeout) {
		$scope._printBarCode = function(printSectionId) {

			var innerContents = document.getElementById(printSectionId).innerHTML;
			var popupWindow = window.open('', 'Print');

			popupWindow.document.write('<!DOCTYPE html><html><head><style type="text/css">@media print { body { -webkit-print-color-adjust: exact; } }</style><link rel="stylesheet" type="text/css" href="barcode.css" media="all" /></head><body> ' + innerContents + '</body></html>');
			$timeout(function() {
				popupWindow.focus();
				popupWindow.print();
				popupWindow.close();
			});
		};

		</script>
		</head>
		<body>
		<svg id="code128"></svg>

		<input type="button" value="Prnt" ng-click="_printBarCode('barCodeId')" class="btn btn-primary" />
		<div id="barCodeId" class="barcodeplace">
		<div class="col-sm-12">
		<div barcode-generator="{{_barCodeGeneraterId}}" style="height:20px;">
		</div>
		</div>
		</div>
		<script src="https://cdn.jsdelivr.net/jsbarcode/3.3.16/barcodes/JsBarcode.code128.min.js"></script>

		</body>
		</html>
