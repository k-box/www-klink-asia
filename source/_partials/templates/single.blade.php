@verbatim

{{#data}}
	<div class="single">

		<div class="bg-black min-h-64 py-4 mb-4">
			<div class="container text-white">
				
				{{#hasEmbed}}
					<div class="embed-container">
						{{{ embed }}}
					</div>
				{{/hasEmbed}}

				{{^hasEmbed}}
					{{#isVideo}}
						<video class="preview__video" src="{{{ url }}}" poster="{{{ thumbnail }}}" controls preload="none"></video>
					{{/isVideo}}
				{{/hasEmbed}}

				
				
				{{^isVideo}}
					{{^hasEmbed}}
						<img class="preview__image block min-h-64 h-half-screen" src="{{{ thumbnail }}}" alt="{{{title}}}">
					{{/hasEmbed}}
				{{/isVideo}}
			</div>
		</div>

		<div class="container flex flex-col">
			
			<h1 class="w-2/3 mb-4">{{{title}}}</h1>

			<div class="md:flex md:justify-between">
				<div class="single__abstract w-1/2 text-grey-darker">{{{ abstract }}}</div>
				
				<div class="w-1/3 flex flex-col">
					<div class="mb-3">
						<a href="{{{ url }}}" class="inline-block no-underline p-2 bg-blue hover:bg-blue-dark focus:bg-blue-dark active:bg-blue-darker transition outline-none text-white shadow hover:shadow-raised hover:translateY-2px">Download file</a>
					</div>

					<div class="mb-3 flex items-center">
						<div class="inline-block type type-{{{ type }}} h-12 w-12"></div>
						{{#video.duration}}
							<span>{{{ video.duration }}}</span>
						{{/video.duration}}
					</div>

					<span class="mb-3">Copyright: {{{ copyright.licence }}} {{{ copyright.contact }}}</span>

					<span class="mb-3">Language: {{{ language }}}</span>
					<span class="mb-3">Source: {{{ raw.uploader.url }}}</span>
					
					{{^isVideo}}
						<span class="mb-3">Size: {{{ size }}}</span>
					{{/isVideo}}
				</div>
			</div>

			
			

			


		</div>
		
	</div>
{{/data}}

@endverbatim
