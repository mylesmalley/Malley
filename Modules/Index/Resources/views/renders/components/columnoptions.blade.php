@php
	$cols = (isset($columns)) ? $columns : 2;
	
	$messages = [];

	foreach ($passed_data as $option)
	{
	    if ( array_key_exists($option, $selected) )
	    {
	    	$value = $selected[$option]->description ;
			$messages[] = "<p><span class='initials'>P</span>&nbsp; <span class='initials'>QA</span>&nbsp;<strong>{$option}</strong> -   {$value}</p>";
	    }
	}

	$max = count($messages);
	$counter = 1;
	$max_per_column = ceil($max / $cols);
	$col_with = 100 / $cols;


@endphp
<table>
	<tr>
		<td valign="top" style="width:{{$col_with}}%;">
			@foreach($messages as $message)
			    {!! $message !!}	    
			    @php 
			    	if ($counter == $max_per_column)
			    	{
			    		echo "</td><td valign='top' style='width:{$col_with}%;'>";
			    		$counter = 0;
			    	}
			    	$counter++;
			    @endphp
			@endforeach
		</td>
	</tr>
</table>