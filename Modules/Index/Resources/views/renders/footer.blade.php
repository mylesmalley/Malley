<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Drawing</title>
  <meta name="description" content="Malley Blueprint Rendering">
  <meta name="author" content="Malley Blueprint">
  <style type="text/css">
  		html,body {
  			width:100%;
  			font-family: Arial;
  			font-size: 10pt;
  		}
  		#footer-wrapper{
  			border-top: 2px solid black;
  			margin-top:5px;
  		}
  		#footer-wrapper table {
  			width:100%;
  		}
  </style>
  <script>
  function subst() {
      var vars = {};
      var query_strings_from_url = document.location.search.substring(1).split('&');
      for (var query_string in query_strings_from_url) {
          if (query_strings_from_url.hasOwnProperty(query_string)) {
              var temp_var = query_strings_from_url[query_string].split('=', 2);
              vars[temp_var[0]] = decodeURI(temp_var[1]);
          }
      }
      var css_selector_classes = ['page', 'frompage', 'topage', 'webpage', 'section', 'subsection', 'date', 'isodate', 'time', 'title', 'doctitle', 'sitepage', 'sitepages'];
      for (var css_class in css_selector_classes) {
          if (css_selector_classes.hasOwnProperty(css_class)) {
              var element = document.getElementsByClassName(css_selector_classes[css_class]);
              for (var j = 0; j < element.length; ++j) {
                  element[j].textContent = vars[css_selector_classes[css_class]];
              }
          }
      }
  }
  </script>
  </head>
  <body onload="subst()">
  <div id='footer-wrapper'>
	<table cellpadding="4">
		<tr>
			<td valign="top">
				Prepared By:<br />
				@if ($blueprint->user->company->logo)
					<img width="225" src="{{ $blueprint->user->company->logo }}" />		
				@endif
			</td>
			<td>
				<b>{{ $blueprint->user->company->name }}</b><br />
				{{ $blueprint->user->company->address_1 }}<br />
				{{ $blueprint->user->company->city }},{{ $blueprint->user->company->province }}, {{ $blueprint->user->company->country }}<br />
				{{ $blueprint->user->company->postalcode }}
			</td>
			<td valign="top">
				Prepared For:<br />
				<b>{{ $blueprint->customer_name }}</b><br />
				{{ $blueprint->customer_address_1 }}<br />
				{{ $blueprint->customer_city }},{{ $blueprint->customer_province }}, {{ $blueprint->customer_country }}<br />
				{{ $blueprint->customer_postalcode }}
			</td>
			<td valign="top">
				{{ $blueprint->updated_at }}<br />
				&copy; Malley Industries Inc. 2017<br />
				Blueprint v.1.0&nbsp; &nbsp; <b>B-{{ $blueprint->id }}</b><br />
				<b>Page <span class="page"></span> of <span class="topage"></span></b>
			</td>
		</tr>
	</table>
	</div>
	</body>
</html>
