
<div style='   display:block;   height:{{ $height }}px;  width:{{ $width }}px;   position:relative;   ' class='images'>
        @foreach($passed_data as $vals)
                @if ( array_key_exists($vals[0], $selected) )
  <div style=' position: absolute; top: 0;  left: 0;  width: 100%; height: 100%;' >
    <img src='{{ url('drawing/'.$drawings[$vals[1]]->id).'/thumbnail/'.$width }}' alt='{{ $vals[0] }}' />
  </div>
                  @endif
        @endforeach
</div>