@extends('admin.layouts.app')
@section('content')
<section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Create Sub Category</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="{{ route('subcategories.index') ?? '' }}" class="btn btn-primary">Back</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
					<div class="container-fluid">
					<form action="{{ route('subcategories.store') }}" method="POST">
					@csrf
						<div class="card">
							<div class="card-body">								
								<div class="row">
                                    <div class="col-md-12">
										<div class="mb-3">
											<label for="categories_id">Category</label>
											<select name="categories_id" id="categories_id" class="form-control">
                                              @foreach($categories as $item)
                                              <option value="{{$item->id}}" {{ old('categories_id') == $item->id ? 'selected' : '' }}>
                                              {{$item->name}}
                                               </option>
                                               @endforeach
                                               </select>

										@error('categories_id')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror	
										</div>
										
									</div>

									<div class="col-md-6">
										<div class="mb-3">
											<label for="name">Name</label>
											<input type="text" name="name" id="name" class="form-control" placeholder="Name">	
											@error('name')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
										</div>
									</div>
									<div class="col-md-6">
                            <div class="mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Blocked</option>
                                </select>
                            </div>
                        </div>								
								</div>
							</div>							
						</div>
						<div class="pb-5 pt-3">
							<button type="submit" class="btn btn-primary">Create</button>
							<a href="{{route('subcategories.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
						</div>
						</form>
					</div>
					<!-- /.card -->
				</section>
                @endsection