<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">SCM Bulletin Board</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a href="{{route('user.index')}}" class="nav-link">Users <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a href="{{route('user.profile')}}" class="nav-link" href="#">User</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('post.postlist')}}">Posts</a>
            </li>
        </ul>
        <ul class="navbar-nav pull-right">
            <li class="nav-item active mr-10"><span class="nav-link"> Login username</span></li>
            <li class="nav-item active"><a href="{{route('user.login')}}" class="nav-link"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
    </div>
</nav>