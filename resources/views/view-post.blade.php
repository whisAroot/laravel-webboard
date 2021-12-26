<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>แสดงกระทู้เว็บบอร์ด</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet"> 
    <style>
        body, th, td{
            font-family: 'Itim', cursive;
            font-size:20px
        }
    </style>
    <!-- font end -->
    <!--tinycme-->
    <script src="https://cdn.tiny.cloud/1/4r7d8dodkqax7a64a16l2pz8buqk9wrtv6w1ors3z4m0w3ig/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    @include('components.navbar')
    <div class="container" style="padding-top: 20px">
        <div class="row">
            <div class="col-md-12">
                @if (Session::has('success'))
                <script>swal("ความคิดเห็น", "{{Session::get('success')}}", "success");</script>
                @endif
                <div class="card">
                    <div class="card-header">
                        <strong>{{$post->title}}</strong>
                    </div>
                    <div class="card-body">
                        {!!  $post->detail  !!}
                    </div>
                    <div class="card-footer">
                        {{$post->name}} | {{$post->created_at}}
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                @foreach ($comments as $key=>$comment)
                <div class="card" style="width: 90%; margin:auto;">
                    <div class="card-header">
                        ความคิดเห็นที่ {{$key+1}}
                    </div>
                    <div class="card-body">
                        {!! $comment->detail !!}
                    </div>
                    <div class="card-footer">
                        {{ $comment->name}} | {{ $comment->created_at}}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                @if (Auth::user()->role == 'ADM')
                    <form action="{{route('admin.commentpost')}}" method="post">
                @else
                    <form action="{{route('user.commentpost')}}" method="post">
                @endif
                    @csrf
                    <div class="card" style="width: 90%; margin:auto;">
                        <div class="card-header">
                            แสดงความคิดเห็น
                        </div>
                        <div class="card-body">
                            <textarea name="detail" id="" cols="" rows="4"></textarea>
                            @error('detail')
                                <span class="error text-danger">{{message}}</span>
                            @enderror
                        </div>
                        <input type="hidden" name="idPost" value="{{$post->id}}">
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">แสดงความคิดเห็น</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    <script>
        tinymce.init({
          selector: 'textarea',
       });
    </script>
</body>
</html>