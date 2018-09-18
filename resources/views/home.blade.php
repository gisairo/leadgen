@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
    
                    You are logged in!
                </div>
                
            </div>
            <br>
            <div class="row">
                <div class="col-md-10">
                    <div class="container">
                        <div class="row mb-4">
                            <a class="btn btn-primary btn-large new-message" href="{{ url('/home/new') }}">New Message</a>
                            <br/> &nbsp;
                            <a class="btn btn-primary btn-large export" href="{{ url('/home/export') }}">Export Messages</a>
                        </div>
                        
                        
                    </div>

                   
                </div>
                <div class="col-md-12">
                    <div class="bs-example">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    Messages Sent        
                                </div> 
                            </div>
                            <div class="card-body">
                                <p>See the messages your sent along with their status in the list below</p>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>

                                        <th scope="col">#</th>
                                        <th scope="col">Message ID</th>
                                        <th scope="col">Message</th>
                                        <th scope="col">Number</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">StatusCode</th>
                                        <th scope="col">Cost</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($messages as $message)
                                        <tr>
                                            <th>{{ $message->id }}</th>
                                            <td>{{ $message->message_id }}</td>
                                            <td>{{ $message->message }}</td>
                                            <td>{{ $message->number }}</td>
                                            <td>{{ $message->status }}</td>
                                            <td>{{ $message->status_code }}</td>
                                            <td>{{ $message->cost }}</td>
                                        </tr>
                                        
                                    @endforeach
                                </tbody>
                            </table>
                           
                            
                            <div class="card-footer">
                                {{ $messages->links() }}
                            </div>
                        </div>
                        
                        
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
