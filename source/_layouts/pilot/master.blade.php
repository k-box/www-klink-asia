@extends('_layouts.master')

@section('body')

    @include('_layouts.pilot.navigation')
    
    <div class="pilot">
        @yield('pilotbody')
    </div>

    <footer class="bg-pilot-darker py-4 text-white">
		<div class="container flex justify-between">

			<div class="w-1/3">
				The creation of the K-Link is carried out in the framework of the EU project FLERMONECA as well as with the support of the German Federal Government through the Regional Programme for Sustainable Use of Natural Resources in Central Asia of the Deutsche Gesellschaft für Internationale Zusammenarbeit (GIZ) GmbH.
			</div>
				
			<div class="w-1/3">
				
				<h4>GIZ</h4>

				<p class="address">
					22, Erkindik Blvd.<br/>
					720040 Bishkek<br/>
					Kyrgyz Republic
				</p>

				<p class="contacts">
					T. + 996 312 90 93 40<br/>
					F. + 996 312 90 90 80<br/>
					E. nr-info@giz.kg<br/>
					<a class="text-pilot-lighter hover:text-white" href="http://www.giz.de">www.giz.de</a><br/>
					<a class="text-pilot-lighter hover:text-white" href="http://www.naturalresources-centralasia.org">www.naturalresources-centralasia.org</a>
				</p>

			</div>

			


	</footer>
    
@endsection
