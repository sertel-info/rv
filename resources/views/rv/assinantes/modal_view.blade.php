
@component('layouts.modal')
	@slot('id')
		modal-assinantes
	@endslot

	@slot('class')
		modal-view
	@endslot

	@slot('body')
		<h1 class='view-title'> </h1>
		<hr>
		<table class='table table-centered'>
			<caption>Dados Básicos</caption> 
			<thead>
				<th>Item</th>
				<th>Valor</th>
			</thead>
			<tbody>

			</tbody>
		</table>
	@endslot

@endcomponent
