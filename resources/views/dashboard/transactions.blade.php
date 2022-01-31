@extends('preload.default')

@section('container')
	@include('partials.specific_modals')
	@include('partials.header')
	
	<div class="w-full shadow stats text-center">
		<div class="stat">
			<div class="stat-figure text-primary">
			  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current">                     
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>     
			  </svg>
			</div>

			<span class="stat-title">Price</span> 
			<span class="stat-value text-primary my-2">Rp. <span id="price_view">0</span> </span> 
			<span class="stat-desc"><span id="discount_view">0</span>%  Discount</span>
		</div> 

		<div class="stat">
			<div class="stat-figure text-info">
			  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current">                     
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>     
			  </svg>
			</div>

			<span class="stat-title">Additional Fee</span> 
			<span class="stat-value text-info my-2">Rp. <span id="fee_view">0</span></span> 
			<span class="stat-desc">Fee gained from special requirement</span>
		</div>

		<div class="stat">
			<div class="stat-figure text-accent">
			  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current">                     
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>     
			  </svg>
			</div>

			<span class="stat-title">Tax</span> 
			<span class="stat-value text-accent my-2">Rp. <span id="tax_view">0</span></span> 
			<span class="stat-desc">2% tax from packages and quantity.</span>
		</div>
	</div>

	<form action="/transaction" method="post" class="text-center">
		@csrf

		<input type="hidden" name="transaction_price" id="transaction_price" value="0">
		<input type="hidden" name="fee_price" id="fee_price" value="0">
		<input type="hidden" name="tax_price" id="tax_price" value="0">

		<div class="flex flex-row">
			<div class="flex-1 mx-4 w-full">
				<div class="form-control">
					<label class="label">
						<span class="label-text">Outlet ID</span>
					</label>

					<div class="input-group">
						<input type="hidden" name="outlet_id" id="outlet_input_real"
							value="{{ Auth::user()->outlet_id }}">
						<input type="text" id="outlet_input" class="input input-bordered w-full"
							value="{{ Auth::user()->outlets->outlet_name }}" readonly>
					</div>
				</div>

				<div class="form-control my-4">
					<label class="label">
						<span class="label-text">Member ID</span>
					</label>

					<div class="input-group">
						<input type="hidden" name="member_id" id="member_input_real"
							value="">
						<input type="text" id="member_input" class="input input-bordered w-full"
							value="" readonly>
						<button type="button" class="btn btn-primary" onclick="document.getElementById('find_member').classList.add('modal-open')">Find</button>
					</div>
				</div>

				<div class="form-control my-4">
				    <label class="cursor-pointer label">
				      	<span class="label-text">Toggle notes</span> 
				      	<input type="checkbox" class="toggle toggle-accent" onclick="toggle_note(this)">	
				    </label>

					<span class="text-justify text-sm opacity-50">Adding notes to the transaction will increase fee.</span>
				</div>

				<div class="form-control w-full hidden" id="note_textarea">
					<label class="label">
						<span class="label-text">Notes</span>
					</label> 
				
				  	<textarea class="textarea h-32 textarea-bordered" placeholder="Notes"></textarea>
				</div> 
			</div>

			<div class="flex-1 mx-4 w-full">
				<div class="form-control">
					<label class="label">
						<span class="label-text">Deadline Time</span>
					</label>

					<div class="flex-row">
						<input type="date" name="deadline_time" id="deadline_input" class="input input-bordered w-full" required>
					</div>
				</div>

				<div class="form-control my-4">
					<label class="label">
						<span class="label-text">Package Type</span>

						<button type="button" class="btn btn-primary btn-sm w-2/12" 
								onclick="document.getElementById('find_package').classList.add('modal-open')">Find</button>
					</label>

					<div class="input-group">
						<input type="hidden" name="package_id" id="package_input_real"
							value="">
						<input type="text" id="package_input" class="input input-bordered w-full"
							value="" readonly>

						<input type="number" name="package_quantity" id="quantity_input" class="input input-bordered w-3/4" value="1" min="1" disabled required>
					</div>
				</div>

				<div class="form-control">
					<label class="label">
						<span class="label-text">Discount</span>
					</label>

					<div class="flex-row">
						<select name="package_type" id="type_input" class="select select-bordered w-full">
							<option value="0">No Discount</option>
							<option value="10">10% Discount</option>
							<option value="20">20% Discount</option>
							<option value="30">30% Discount</option>
						</select>
					</div>
				</div>
			</div>
		</div>

		<button type="submit" class="btn btn-primary my-10">Create Package</button>
	</form>
@endsection