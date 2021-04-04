@extends('layouts.admin')

@section('content')
    <div class="w-full">
    	<div class="">
	    	
		    <!-- Emails Lists -->

	   		<div class="overflow-x-scroll w-full md:overflow-auto md:w-full">
		        <table class="table-auto  w-full mb-8 overflow-x-scroll md:overflow-x-auto" >
				    <thead>
				    <tr>
				      <th class="px-4 py-2 text-left text-capitalize text-gray-600">Email</th>
				      <th class="px-4 py-2 text-left text-capitalize text-gray-600">Created At</th>
				      <th class="px-4 py-2 text-left text-capitalize text-gray-600"></th>
				    </tr>
				    </thead>
				    <tbody>
				  	
				  	@forelse($emails as $email)
				    <tr>
				     
				        <td class="border px-4 py-4">
                            {{ $email->email }}
                        </td>
				        <td class="border px-4 py-4">{{ $email->created_at->diffForHumans() }}</td>
				        
                        <td class="border px-4 py-4">
				      	

				      	<form action="{{ route('newsletter.destroy', $email->id) }}" method="POST" accept-charset="utf-8">
				      			
			      			@csrf
			      			@method('DELETE')
                            <button  
                                onClick="return confirm('Are you sure');" 
                                type="submit" 
                                class="rounded-lg text-white ">

                                <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash h-8 w-8 text-red-600 hover:opacity-80 cursor-pointer"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                            </button>
			      		</form>
				      </td>
				    </tr>
				    @empty
				    	<tr>
					        <td class="border px-4 py-4">No email</td>
					    </tr>
				    @endforelse

				    </tbody>
				</table>
			</div>

				<div class="my-6 flex justify-center items-center w-full px-4">
					{{  $emails->links() }}
				</div>

			</div>

		</div>

    </div>
@endsection

@push('scripts')

	
@endpush