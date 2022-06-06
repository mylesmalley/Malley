@extends('syspro::syspro.template')
{{--@extends('index::app.main')--}}

@section('stylesheet')
	<!--
		@foreach( $costs as $k => $v )
			{{ $k }} = {{ $v }}
		@endforeach
		@foreach( $raw as $k => $v )
			{{ $k }} = {{ $v }}
		@endforeach
	-->


	<style>

		#stockCodeDetails
		{
			grid-area: box1;
		}

		#production
		{
			grid-area: box3;
		}

		#distribution
		{
			grid-area: box2;
		}

		#binLocations
		{
			grid-area: box4;
		}

		#detail
		{
			grid-area: foot;
		}

		#top-menu
		{
			grid-area: top-menu;
		}

        #structure
        {
            grid-area: box5;
            overflow-y: auto;
        }

        #whereUsed
        {
            grid-area: box6;
            overflow-y: auto;
        }

		.parent {
			height: 100vh;
			display: grid;
			grid-template-columns: 33% 34% 33%;
			grid-template-rows: 40px auto auto;
			grid-template-areas:
				"top-menu top-menu top-menu"
				"box1 box2 box3"
				"box4 box5 box6";
			grid-column-gap: 10px;
			grid-row-gap: 10px;
		}

        .syspro-window-content
        {
            /*overflow-y: hidden !important;*/

        }
	</style>
@endsection

@section("content")
	<div class="parent">

        <!--
            x x x
            - - -
            - - -
        -->
        @includeIf('syspro::syspro.inventoryQuery.panes.topMenu')


         <!--
            - - -
            x - -
            - - -
        -->
        @includeIf('syspro::syspro.inventoryQuery.panes.stockCodeDetails')


        <!--
            - - -
            - x -
            - - -
        -->
        @includeIf('syspro::syspro.inventoryQuery.panes.pricing')



        <!--
            - - -
            - - x
            - - -
        -->
        @includeIf('syspro::syspro.inventoryQuery.panes.inventory')






        <!--
            - - -
            - - -
            x - -
        -->
        @includeIf('syspro::syspro.inventoryQuery.panes.binLocations')

    <!--
            - - -
            - - -
            - x -
        -->
    @includeIf('syspro::syspro.inventoryQuery.panes.whereUsed')


    <!--
            - - -
            - - -
            - - x
        -->
        @includeIf('syspro::syspro.inventoryQuery.panes.bomStructure')


















    </div>
@endsection

@section('scripts')
{{--	<script>--}}
{{--		document.getElementById('findButton').addEventListener('click', function(){--}}
{{--			window.open("https://www.google.com");--}}
{{--		});--}}
{{--	</script>--}}
	@endsection
