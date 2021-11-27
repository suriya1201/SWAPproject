<html>
<style type="text/css">
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color:red;
}

li {
  float: left;
}

li a {
  display: block;
  color: black;
  text-align: center;
  padding: 19px 16px; /*height and width of top nav */
  text-decoration: none;
}

/* Change the link color to #111 (black) on hover */
li a:hover {
  background-color: white;
}
/* Add a gray right border to all list items, except the last item (last-child) */
li {
  border-right: 2px solid #bbb;
}

li:last-child {
  border-right: none;
}
footer {
  background-color: #F1F1F1;
  text-align: center;
  padding: 10px;
}
</style>
<head>

<ul>
  <li><a href="#home">Home</a></li>
  <li><a href="#news">News</a></li>
  <li><a href="#contact">Contact</a></li>
  <li style="float:right"><a class="active">Login</a></li>
</ul>


</head>
<body><h1>THIS SHALL BE THE BODY</h1></body>

<footer>
    Copyright &copy; Temasek Polytechnic
    </footer>
    </html>