<!doctype html>
<html lang="en">
	<head>
		<style>
			html, body {
				font-size: 24pt;
			}
			.wrapper
			{
				border: 2px solid black;
				width: 4in;
				display: block;
				padding: 10px;
			}
			#header
			{
				
				display: block;
			}
			.black-box
			{
				background-color: black;
				color: white;

			}
			
			.float-right
			{
				display: block;
				float:right;
			}
			.show-inline
			{
				display: inline;
			}
			.label
			{
				padding: 5px;
				font-size: 24pt;
			}
			.location
			{
				font-size: 24pt;
				
			}
			.bin-location
			{
				font-size: 72pt;
				text-align: center;
			}
			.part-info-row
			{
				margin-bottom: 5px;
			}
			.description
			{
				font-size: 18pt;
			}
		</style>
	</head>
	<body>
		@for( $i = 0; $i < count($codes); $i++ )
			
			@php
				$code = trim( $codes[$i]->StockCode )
				. ' - ' .  trim( $codes[$i]->GroupID )
				. ' - ' .  trim( $codes[$i]->DefaultBin );
			
			@endphp
			
			
		<div class="wrapper">
			<div id="header">
				<div class="label show-inline">KANBAN</div>
				<div class="location black-box show-inline float-right">
					{{ trim( $codes[$i]->GroupID ) }}
				</div>
			</div>
			<div class="part-info-row">
				<div class="black-box show-inline">
					{{ trim( $codes[$i]->StockCode ) }}
				</div>
				<div class="black-box float-right show-inline">
					6 PCS
				</div>
			</div>
			<div class="bin-location-row">

				<div class="bin-location ">
					<img src="data:image/png;base64,{!! DNS2D::getBarcodePNG( $code , "QRCODE", 8,8) !!}" width="100" height="100" alt="barcode"   />

					{{ trim( $codes[$i]->DefaultBin ) }}
				</div>
			</div>
			<div class="description">
				{{ trim( $codes[$i]->Description ) }}
			
			</div>
		</div>
	
			@endfor
	</body>
</html>
