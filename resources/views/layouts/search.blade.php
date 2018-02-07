<form id="searchForm" class="form" method="post">

	{{ csrf_field() }}
	<div class="row">
		
		<div class="form-group col-sm-6">
			<div class="input-group">
				<span class="input-group-btn ">
					<button class="btn btn-default" type="button" data-toggle="collapse"
					data-target="#searchCollapse" aria-expanded="false" aria-controls="searchCollapse">
						<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
					</button>
				</span>
				<input type="search" autofocus="autofocus" spellcheck="false" class="form-control" id="search" placeholder="" value="{{ Session::has('search') ? Session::get('search') : '' }}"
				name="search">
				<span class="input-group-btn">
					<button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
				</span>
			</div>
			
		</div>
	
	

		<div class="form-group col-sm-3 form-inline">
			<label for="pag">Rezultate / Pagina</label>
			<select id="pag" name="pag" class="form-control" value="{{ Session::has('pag') ? Session::get('pag') : '' }}">
				<option vlue="10" {{ Session('pag') == "10" ? 'selected' : '' }}>10</option>
				<option vlue="25" {{ Session('pag') == "25" ? 'selected' : '' }}>25</option>
				<option vlue="50" {{ Session('pag') == "50" ? 'selected' : '' }}>50</option>
			</select>
		</div>


		@yield('buttons')

	</div>

	<div class="row">
		<div class="col-sm-10 col-md-8">
		<div class="collapse panel panel-default" id="searchCollapse">
				
				<div class="panel-body">
					<h3>Cautare Simpla</h3>
					<p>Scrie unul sau mai multe cuvinte.
					Acestea vor fi cautete in urmatoarele campuri:
					<code>Prenume</code>, <code>Nume</code>, <code>Extensie</code>,
					<code>Mobil</code>, <code>Departament</code>, <code>Functie</code>, <code>Locatie</code></p>
					
					<br>
					{{-- <hr> --}}
					<h3>Cautare Avansata</h3>
					
					<p>Pentru o filtrare mai exacta, se pot folosi expresii de forma:
					 <code>&lt;camp&gt;: &lt;valoare&gt;</code> sau <code>&lt;camp&gt;: "&lt;valoare1&gt; &lt;valoare2&gt;..."</code></p>
					<p>Numele campului poate fi scris partial. Expresiile <kbd>d: "abc"</kbd>, <kbd>dep: "abc"</kbd>, <kbd>depart: "abc"</kbd> etc. sunt echivalente.</p>
					<div class=bs-example data-example-id=inline-code>
						De exemplu <kbd>functie: consilier</kbd> sau <kbd>departament: "resurse umane"</kbd>
					</div>
					<div class="bs-callout bs-callout-info" id="callout-xref-input-group">
						<h4>Expresii</h4>
						<p>Expresiile se pot folosi singure sau impreuna cu termenii simpli de cautare.</p>
					</div>
				</div>
				
			</div>
		</div>
	
	</div>
	
	@if(!empty($results))
		<div class="col-sm-3 form-inline">
			Rezultate: <span>{{$results->total()}}</span>
		</div>
	@endif
	

</form>