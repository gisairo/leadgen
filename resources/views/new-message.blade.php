@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        	<div class="card">
                <div class="card-header">Compose new message</div>
            </div>
            <br>

            <div class="row mb-4">
            	<div class="col-md-8">
                    <div class="bs-example">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    New Message        
                                </div> 
                            </div>
                            <div class="card-body">
                                @if (session('status'))
			                        <div class="alert alert-success" role="alert">
			                            {{ session('status') }}
			                        </div>
			                    @endif
			                    @if ($errors->any())
			                        <div class="alert alert-danger">
			                            <ul>
			                                @foreach ($errors->all() as $error)
			                                    <li>{{ $error }}</li>
			                                @endforeach
			                            </ul>
			                        </div>
			                    @endif

			                    <form action="{{url('/home/store')}}" method="post" accept-charset="utf-8">
			                    	@csrf
			                    	 <div class="form-group">
			                    	 	<label for="phonenumber"> Recipient Phone Number: </label>
			                    	 		<input type="tel" name="phonenumber" id="phonenumber" class="form-control" placeholder="Phone number e.g +2547123456">
			                    	 </div>
			                    	 <div class="form-group">
			                    	 	<label for="message"> Message: </label>
			                    	 		<textarea class="form-control" id="message" rows="3" name="message" placeholder="Type your message here"></textarea>
			                    	 </div>
			                    	 <button type="submit" class="btn btn-primary" name="btn-submit">Submit</button>
			                    </form>

                            </div>
                            <div class="card-footer">

                            </div>
                        </div>
                    </div>
                </div>
            	<div class="col-md-10">
                    <div class="container">
                        <div class="row mb-4 mt-4">
                            <a class="btn btn-primary btn-large new-message" href="{{ url('/home') }}">Go Back</a>
                            <br/> &nbsp;
                        </div>
                        
                        
                    </div>

                   
                </div>
            </div>

        </div>
       
    </div>
</div>
@endsection