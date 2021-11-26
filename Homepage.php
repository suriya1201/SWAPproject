<html>
<head>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <a class="navbar-brand" href="#">
        <img src="images/popcorn.png" width="30" height="30" class="d-inline-block align-top" alt="">SG Movies
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navSupportedContent">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item active" id="nowMenu">
                <a class="nav-link" href="#" id="now" onclick="listNowShowingMovies()">Now Showing</a>
            </li>
            <li class="nav-item" id="comingMenu">
                    <a class="nav-link" href="#" id="coming" onclick="listComingMovies()">Coming Soon</a>
            </li>
            <li class="nav-item" id="aboutMenu">
                    <a class="nav-link" href="#" id="about" data-toggle="modal" data-target="#messageModal">About</a>
            </li>
        </ul>
    </div>
    </nav>
</head>
</html>