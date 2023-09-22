<x-admin-master>

    @section('content')
        <h1>User Profile of {{$user->name}}</h1>
        <div class="row">
            <div class="container">
                <div class="col">
                    <div class="card my-4">
                        <div class="card-header">
                            <h4>User Profile</h4>
                        </div>
                        <div class="card-body">

                            <form method="post"action="{{route('user.profile.update',$user)}}" enctype="multipart/form-data">

                                @csrf
                                @method('PUT')

                               <div class="mb-4">
                                   <img src="{{$user->avatar}}" height="80px" alt="" class="img-profile rounded-circle">
                               </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="avatar">
                                    <label for="image" class="custom-file-label">Choose File</label>
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" value="{{$user->username}}">

                                    @error('username')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{$user->name}}">


                                    @error('name')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="Email">Email</label>
                                    <input type="text" name="email" class="form-control" value="{{$user->email}}">


                                    @error('email')
                                    <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control {{$errors->has('username')?'is-invalid':''}}"
                                           value="{{$user->password}}">

                                    @error('passeword')
                                    <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="text" name="password_confirmation" class="form-control" placeholder="Confirm Password">

                                    @error('password_confirmation')
                                    <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>



                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-admin-master>
