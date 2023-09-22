<x-admin-master>
    @section('content')

        <div class="card">
            <div class="card-header">
                <h4>Edit a Post</h4>
            </div>
            <div class="card-body">

                <form method="post"action="{{route('post.update',$post->id)}}" enctype="multipart/form-data">

                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter Title" value="{{$post->title}}">
                    </div>

                    <div class="form-group">
                        <label for="image">Upload Image</label>
                        <div ><img height="100px"src="{{$post->post_image}}"> </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="post_image">
                            <label for="image" class="custom-file-label">Choose File</label>
                        </div>
                        <small class="form-text text-muted">Max Size 3 mb</small>
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea name="body" class="form-control">{{$post->body}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>


    @endsection



</x-admin-master>
