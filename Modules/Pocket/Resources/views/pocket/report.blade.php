@extends('layouts.pdf')
@section('content')
<h3>{{ $page_title }}</h3>
<table class="table table-bordered">
	<tbody>
		<tr>
			<td class="bg-header text-center" style="width: 5%"><strong>SL</strong></td>
			<td class="bg-header" style="width: 25%"><strong>Day</strong></td>
			<td class="bg-header" style="width: 55%"><strong>Description</strong></td>
			<td class="bg-header text-right" style="width: 15%"><strong>Amount</strong></td>
		</tr>
		@if(isset($data['entries'][0]))
		@foreach($data['entries'] as $key => $entry)
			<tr>
				<td class="text-center">{{ $key+1 }}.</td>
				<td>{{ date('l jS M, Y',strtotime($entry->date)) }}</td>
				<td>{!! $entry->title !!}</td>
				<td class="text-right {{ $entry->entry_type_id == 1 ? 'text-success' : 'text-danger' }}">
					({{ $entry->entry_type_id == 1 ? '+' : '-' }}) {{ moneyFormat($entry->amount) }}
				</td>
			</tr>
		@endforeach
		@endif
		<tr>
			<td colspan="3" class="text-right"><strong>Income</strong></td>
			<td class="text-right"><strong class="text-success">(+) {{ moneyFormat($data['income']) }}</strong></td>
		</tr>
		<tr>
			<td colspan="3" class="text-right"><strong>Expense</strong></td>
			<td class="text-right"><strong class="text-danger">(-) {{ moneyFormat($data['expense']) }}</strong></td>
		</tr>
		<tr>
			<td colspan="3" class="text-right"><strong>Pocket</strong></td>
			<td class="text-right"><strong class="text-success">{{ textMoneyFormat($data['pocket']) }}</strong></td>
		</tr>
	</tbody>
</table>
@endsection