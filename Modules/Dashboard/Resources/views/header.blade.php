@php
	$systemInformation = session()->get('system-information');
@endphp
<div class="row">
	<div class="col-md-1 text-left">
		<img src="{{ url('system-images/logos/'.$systemInformation->logo) }}" style="width:  100%">
	</div>
	<div class="col-md-11">
		<h2><strong>{{ $systemInformation->name }}</strong></h2>
		<h5>{{ $systemInformation->motto }}&nbsp;|&nbsp;{{ $systemInformation->tagline }}</h5>
		<h6>{{ $systemInformation->description }}</h6>
		<p>
			<small>
				<i class="fas fa-phone-square-alt"></i>&nbsp;&nbsp;<a href="tel:{{ $systemInformation->phone }}">{{ $systemInformation->phone }}</a>
				&nbsp;&nbsp;&nbsp;
				<i class="fas fa-mobile"></i>&nbsp;&nbsp;<a href="tel:{{ $systemInformation->mobile }}">{{ $systemInformation->mobile }}</a>
				&nbsp;&nbsp;&nbsp;
				<i class="fas fa-envelope"></i>&nbsp;&nbsp;<a href="mailto:{{ $systemInformation->email }}">{{ $systemInformation->email }}</a>
				&nbsp;&nbsp;&nbsp;
				<i class="fas fa-globe"></i>&nbsp;&nbsp;<a href="{{ $systemInformation->website }}" target="_blank">{{ str_replace('https://', '', $systemInformation->website) }}</a>
				&nbsp;&nbsp;&nbsp;
				<i class="fas fa-map-marked-alt"></i>&nbsp;&nbsp;{{ $systemInformation->address }}
			</small>
		</p>
	</div>
</div>