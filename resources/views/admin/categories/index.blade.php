@extends('layouts.admin')

@section('content')
    <div class="w-full">
    	<div class="">
	    	
		    <div class="w-full  mt-4">

		        <div class="w-full mb-6 flex flex-col md:flex-row justify-between md:items-center">
			        <h3 class="text-lg text-gray-900 fond-bold w-full md:w-auto mb-3 md:mb-0">Categories {{ $total }}</h3>
				    <div class="flex justify-between items-center w-full md:w-auto">
			    		<form action="{{ route('admin.categories') }}" method="get" accept-charset="utf-8">
			    			@csrf
			    			
			    			<div class="flex w-full flex-col md:flex-row">
						        <input type="text" id="ck_emailField" class="focus:outline-none block  w-full bg-white rounded sm:rounded-r-none px-6 py-2 mb-2 sm:mb-0 border" name="search" placeholder="Name" value="{{ request()->search ?? '' }}">
						        <button type="submit" class="focus:outline-none focus:bg-indigo-light  w-full sm:w-auto bg-gray-900 hover:bg-gray-700 rounded sm:rounded-l-none uppercase text-white font-bold tracking-wide py-2 px-6">Search</button>
						    </div>
			    		
			    			
			    		</form>
			    	</div>
                </div>
                
                <!-- Create Cateogry -->
                <div class="w-full mb-6 ">
		    		<form action="{{ route('admin.categories.store') }}" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
	    			@csrf
	    			<div class="flex flex-col items-center">
	    				<div class="flex flex-wrap mb-6 w-full">
                            <label for="name" class="block w-full text-gray-900 text-sm font-bold mb-2">
                                {{ __('Name') }}:
                            </label>

                            <input id="name" type="name" class="border border-gray-500  px-3 py-2 rounded w-full @error('name') border-red-600 @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <p class="text-c-red text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
	    				<button type="submit" class="px-3 py-3 w-full  rounded-lg bg-gray-900 hover:bg-gray-700 text-white">
			    			Create
			    		</button>
						
	    			</div>
	    		</form>
	    	</div>

            <!-- Categories -->

	   		<div class="overflow-x-scroll w-full md:overflow-auto md:w-full">
		        <table class="table-auto  w-full mb-8 overflow-x-scroll md:overflow-x-auto" >
				    <thead>
				    <tr>
				      <th class="px-4 py-2 text-left text-capitalize text-gray-600">Name</th>
				      <th class="px-4 py-2 text-left text-capitalize text-gray-600">Created At</th>
				      <th class="px-4 py-2 text-left text-capitalize text-gray-600"></th>
				    </tr>
				    </thead>
				    <tbody>
				  	
				  	@forelse($categories as $category)
				    <tr>
				     
				        <td class="border px-4 py-4">
                            <div>
                                <form method="POST" 
                                    action="{{ route('categories.update', $category->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    
                                    <input 
                                        type="text"
                                        name="name"
                                        class="px-3 py-3 rounded-l"
                                        value="{{ $category->name }}" />
                                    <button type="submit" 
                                        class="px-3 py-3 bg-gray-900 hover:bg-gray-700 text-white rounded-r">
                                        Edit
                                    </button>
                                </form>
                            </div>
                        </td>
				        <td class="border px-4 py-4">{{ $category->created_at->diffForHumans() }}</td>
				        
                        <td class="border px-4 py-4">
				      	

				      	<form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" accept-charset="utf-8">
				      			
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
					        <td class="border px-4 py-4">No category</td>
					    </tr>
				    @endforelse

				    </tbody>
				</table>
			</div>

				<div class="my-6 flex justify-center items-center w-full px-4">
					{{  $categories->links() }}
				</div>

			</div>

		</div>

    </div>
@endsection