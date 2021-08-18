@php
	$cols = (isset($columns)) ? $columns : 2;
	
	$messages = [];

	$counter = count($passed_data);
	//echo $counter;
	//echo $passed_data[3];
	$light_pos = 1;

	for ($i = 0; $i < $counter; $i++ )
	{		
	    if ( array_key_exists( $passed_data[$i], $selected) )
	    {
	    	$value = $selected[ $passed_data[$i] ]->description ;

	    	$tmp = strpos( $passed_data[$i], '_');
	  		$note = "";

	  		 if ($tmp)
	  		{
	  	 	$light = explode('_', $passed_data[$i]);
	  	 	$note =  $blueprint->notes['lights'][$light[0]] ; 

	  		}
	  		else
	  		{
	  			$note = "No notes";
	  		}

			 $messages[] = "<p>Light {$light_pos}<br />{$value}</p>  <p style='color:red;'>{$note} </p>";
			 $light_pos ++;
	    }
	    
	}

	/*
	foreach ($passed_data as $option)
	{
	    if ( array_key_exists($option, $selected) )
	    {
	    	$value = $selected[$option]->description ;
			$messages[] = "<p> <strong>{$option}</strong> -   {$value}</p>";
	    }
	}
	*/

	$max = count($messages);
	$counter = 1;
	$max_per_column = ceil($max / $cols);
	$col_with = 100 / $cols;


@endphp
<table cellpadding="0" cellspacing="0">
	<tr>
		@foreach($messages as $message)

		<td valign="top" style="width:{{$col_with}}%;padding:4px; border:1px solid black">
			    {!! $message  !!}	    
			    
		</td>
			@endforeach
	</tr>
</table>