<!DOCTYPE html>
<html>
<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
    <!-- font awesome style -->
    <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
</head>
<body>
@include('sweetalert::alert')
<div class="hero_area">
    <!-- header section strats -->
@include('home.header')
    <!-- end header section -->
    <!-- slider section -->
@include('home.slider')
    <!-- end slider section -->
</div>
<!-- why section -->
@include('home.why')
<!-- end why section -->

<!-- arrival section -->
@include('home.new_arrival')
<!-- end arrival section -->

<!-- product section -->
@include('home.product')
<!-- end product section -->

{{--Comment and Reply starts here--}}
<div style="text-align: center;padding-bottom: 15px">
    <h1 style="font-size: 30px;text-align:center;">Comments</h1>
    <form action="{{url('add_comment')}}" method="Post">
        @csrf
        <textarea  name="comment" id="comment" cols="30" rows="10" placeholder="Comment something here" style="height: 150px;width: 40%"></textarea>
       <br>
        <input type="submit" class="btn btn-primary" value="Comment">
    </form>
</div>

<div style="padding-left: 20%;">
    <h1 style="padding-bottom: 20px;font-size: 20px;">All Comments</h1>
    @foreach($comments as $comment)
    <div>
        <b>{{$comment->name}}</b>
        <p>{{$comment->comment}}</p>

        <a href="javascript:void(0);" onclick="reply(this)" style="   color: blue;"  data-CommentId="{{$comment->id}}">Reply</a>
    </div>
{{--    for reply display--}}
    @foreach($reply as $eachReply)
            @if($comment->id==$eachReply->comment_id)
        <div style="padding-left: 3%;padding-bottom: 10px;padding-top: 10px">
            <b>{{$eachReply->name}}</b>
            <p>{{$eachReply->reply}}</p>
            <a shref="javascript:void(0);" onclick="reply(this)" style="   color: blue;"  data-CommentId="{{$comment->id}}">Reply</a>

        </div>
            @endif
        @endforeach
    @endforeach
{{--    reply text box--}}
    <div style="display: none;" class="replyDiv">
        <form action="{{url('add_reply')}}" method="post">
            @csrf
        <input type="text" id="commentId" name="commentId" hidden>
        <label for="reply"></label>
        <textarea name="reply" id="reply" cols="30" rows="10" style="height: 100px;width: 500px;" placeholder="Reply your views"></textarea>
        <br>
            <button type="submit" class="btn btn-warning" >Reply</button>
        <a href="javascript:void(0);"  class="btn" onclick="reply_close(this)">Close</a>
        </form>
    </div>


</div>
{{--Comment and Reply endshere--}}
<!-- subscribe section -->
@include('home.subscribe')
<!-- end subscribe section -->
<!-- client section -->
@include('home.client')
<!-- end client section -->
<!-- footer start -->
@include('home.footer')
<!-- footer end -->
<div class="cpy_">
    <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

        Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

    </p>
</div>

<script type="text/javascript">
    function reply(caller)
        {
            document.getElementById('commentId').value=$(caller).attr('data-commentId');
            $('.replyDiv').insertAfter($(caller));
            $('.replyDiv').show();

        }
        function reply_close(caller)
            {

                $('.replyDiv').hide();
            }

    document.addEventListener("DOMContentLoaded", function(event) {
        var scrollpos = localStorage.getItem('scrollpos');
        if (scrollpos) window.scrollTo(0, scrollpos);
    });

    window.onbeforeunload = function(e) {
        localStorage.setItem('scrollpos', window.scrollY);
    };
</script>
<!-- jQery -->
<script src="home/js/jquery-3.4.1.min.js"></script>
<!-- popper jhome/s -->
<script src="home/js/popper.min.js"></script>
<!-- bootstrahome/p js -->
<script src="home/js/bootstrap.js"></script>
<!-- custom jhome/s -->
<script src="home/js/custom.js"></script>
</body>
</html>
