<?php
  $selected = $blueprint->selected;
//  dd($selected);
  $drawings = $blueprint->drawings;
  //dd($drawings);
?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Drawing</title>
  <meta name="description" content="Malley Blueprint Rendering">
  <meta name="author" content="Malley Blueprint">

  <style type="text/css">
  html {
    font-family: Arial;

  }
  .initials {
      display: inline-block;
      width:25px; 
      height:22px;
      padding:4px; 
      border:1px solid #333333; 
      color:#AAAAAA;
      text-align: center;
  }

  @media screen {
    div.divFooter {
      display: none;
    }
  }

  .drawingPage {

  }
  .drawingPage p {
    font-size: 11pt;
  }

  .special_instructions
  {
    color:red;
  }

  @media print 
  {
    @page
    {
          size: landscape;
            
    }
   div.divFooter {
      position: fixed;
      bottom: 0;
      padding:5px;
      width:100%;
      z-index: 1000;
      background-color:#eee;
      display:block;
    }   
  }





    .pagebreak  {
      page-break-after: always;
    }


  </style>
  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>

<body>

<div class='divFooter'>@include('renders.footer') </div>

{{-- RAM PROMASTER AMBULANCE DRAWINGS --}}   
@if ( $blueprint->base_van === 1)
    {{-- Cover page --}}
    @include('renders.1.cover')
    <div class="pagebreak"></div>
   
{{-- 
  @include('renders.1.lights') 
  <div class="pagebreak"></div>
--}}


    @include('renders.1.cab')
  <div class="pagebreak"></div>

    @include('renders.1.action')
    <div class="pagebreak"></div>


    @include('renders.1.exterior')
    <div class="pagebreak"></div>


    {{-- Section Pages --}}
    @include('renders.1.colours')
    <div class="pagebreak"></div>


    @include('renders.1.floor')
    <div class="pagebreak"></div>

    @include('renders.1.electrical')
    <div class="pagebreak"></div>

    @include('renders.1.driver')
    <div class="pagebreak"></div>

    @include('renders.1.passenger')
  <div class="pagebreak"></div>

    @include('renders.1.patient')
  <div class="pagebreak"></div>

    @include('renders.1.ceiling')
  <div class="pagebreak"></div>


     @include('renders.3.all')













{{-- FORD TRANSIT AMBULANCE DRAWINGS --}}    
@elseif ( $blueprint->base_van === 3)
    
      @include('renders.3.cover')
    <div class="pagebreak"></div>
   

     @include('renders.3.external')
    <div class="pagebreak"></div>


    @include('renders.3.cab')
  <div class="pagebreak"></div>



    @include('renders.3.driver')
    <div class="pagebreak"></div>

     @include('renders.3.passenger')
    <div class="pagebreak"></div>

    @include('renders.3.electrical')
    <div class="pagebreak"></div>

     @include('renders.3.floor')
    <div class="pagebreak"></div>

     @include('renders.3.colours')
    <div class="pagebreak"></div>


     @include('renders.3.action')
    <div class="pagebreak"></div>


     @include('renders.3.rear')
    <div class="pagebreak"></div>


     @include('renders.3.ceiling')
    <div class="pagebreak"></div>

     @include('renders.3.all')
    <div class="pagebreak"></div>

{{-- FORD TRANSIT CONNECT LOWERED FLOOR --}}
@elseif ( $blueprint->base_van === 4)
    
      @include('renders.4.cover')
    <div class="pagebreak"></div>
   

     @include('renders.4.exterior')
    <div class="pagebreak"></div>



@else
<p>Drawing not configured.</p>
@endif























 <p></p>





















</body>
<script type="text/javascript">
 // window.onload = function() { window.print(); }
</script>
</html>