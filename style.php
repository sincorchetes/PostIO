<?php 
header("Content-type: text/css");

echo "

/* 

FONTS 

*/
@font-face {
 font-family: Comfortaa;
 src: url('fonts/Comfortaa-Regular.eot') /* EOT file for IE */
}

@font-face {
 font-family: Comfortaa;
 src: url('fonts/Comfortaa-Regular.ttf') /* TTF file for CSS3 browsers */
}

/* 

BODY 

*/

body{
font-family: Comfortaa;
background-color:#ADD8E6;
text-rendering:optimizeLegibility;
}

#main{
width:98%;
height:auto;
float:left;
}

#menu{
float:right;
width:20%;
height:auto;
margin-top:100px;
border-radius:10px;
}

#menu h2{
color:#FFFFFF;
}

#menu hr{
height:1px;
}
#menu a{
text-decoration: none;
color:#000000;
}
#menu a:visited{
color:#1E90FF;
text-decoration: none;
}

#menu a:hover{
background-color:#FFFFFF;
text-decoration: none;
}

#post a{
text-decoration: none;
color:#000000;
}
#post a:visited{
color:#1E90FF;
text-decoration: none;
}

#post a:hover{
background-color:#FFFFFF;
text-decoration: none;
}

#post{
float:left;
width:70%;
height:auto;
margin-left:50px;
margin-top:100px;
padding-right:0px;
padding-left:2%;
padding-top:2%;
box-shadow: 0px 0px 5px 1px #999;
border-radius:10px;
background-color:#BFBFBF;

}

#socialmedia{
border-radius:10px;
box-shadow: 0px 0px 5px 1px #999;
padding-left:5%;
padding-right:3%;
width:100%;
float:right;
background-color:#BFBFBF;
}

#search{
float:right;
width:100%;
height:auto;
border-radius:10px;
box-shadow: 0px 0px 5px 1px #999;
margin-top:10%;
padding-left:5%;
padding-right:3%;
background-color:#BFBFBF;
}

#m_link{
border-radius:10px;
width:100%;
box-shadow: 0px 0px 5px 1px #999;
float:right;
margin-top:10%;
padding-left:5%;
padding-right:3%;
background-color:#BFBFBF;
}

#recent_post{
float:right;
width:100%;
height:auto;
border-radius:10px;
box-shadow: 0px 0px 5px 1px #999;
margin-top:10%;
padding-left:5%;
padding-right:3%;
background-color:#BFBFBF;
margin-bottom:20%;
}

#login{
float:right;
width:100%;
height:auto;
border-radius:10px;
box-shadow: 0px 0px 5px 1px #999;
margin-top:10%;
padding-left:5%;
padding-right:3%;
background-color:#BFBFBF;
}

#admin_menu{
float:right;
width:100%;
height:auto;
border-radius:10px;
box-shadow: 0px 0px 5px 1px #999;
margin-top:10%;
padding-left:5%;
padding-right:3%;
background-color:#BFBFBF;
}

#categories{
float:right;
width:100%;
height:auto;
border-radius:10px;
box-shadow: 0px 0px 5px 1px #999;
margin-top:10%;
padding-left:5%;
padding-right:3%;
background-color:#BFBFBF;
}

#author{
float:left;
margin-top:20%;
margin-left:30%;
background-color:#BFBFBF;
box-shadow: 0px 0px 5px 1px #999;
border-radius:10px;
text-align:center;
padding:2% 2% 2% 2%;
margin-bottom:2%;
}

/* 

INPUT's styles

*/

input[type=submit]{
padding:5px 15px; 
background:#ccc; 
border:0 none;
cursor:pointer;
font-family: Comfortaa;
box-shadow: 0px 0px 5px 1px #999;
}

input[type=reset]{
padding:5px 15px; 
background:#ccc; 
border:0 none;
cursor:pointer;
font-family: Comfortaa;
box-shadow: 0px 0px 5px 1px #999;
}

input[type=button]{
padding:5px 15px; 
background:#ccc; 
border:0 none;
cursor:pointer;
font-family: Comfortaa;
box-shadow: 0px 0px 5px 1px #999;
}

input[type=text]{
padding:5px 15px; 
background:#ccc; 
border:0 none;
cursor:text;
font-family: Comfortaa;
box-shadow: 0px 0px 5px 1px #999;
}

input[type=password]{
padding:5px 15px; 
background:#ccc; 
border:0 none;
font-family: Comfortaa;
box-shadow: 0px 0px 5px 1px #999;
}

/* 

Textarea 

*/

textarea{
padding:5px 15px; 
background:#ccc; 
border:0 none;
cursor:text;
font-family: Comfortaa;
box-shadow: 0px 0px 5px 1px #999;
}

/* 

Select 

*/

select{
padding:5px 15px; 
background:#ccc; 
border:0 none;
font-family: Comfortaa;
box-shadow: 0px 0px 5px 1px #999;
}

/* 

Dialog class 

*/

.op_ex{
float:left;
margin-top:5%;
margin-left:30%;
background-color:#BFBFBF;
box-shadow: 0px 0px 5px 1px #999;
border-radius:10px;
text-align:center;
padding:2% 2% 2% 2%;
margin-bottom:2%;
}

.check{
float:left;
margin-top:5%;
margin-left:20%;
background-color:#BFBFBF;
box-shadow: 0px 0px 5px 1px #999;
border-radius:10px;
text-align:center;
padding:2% 2% 2% 2%;
margin-bottom:2%;
}

.setup-admin{
float:left;
margin-top:5%;
margin-left:2%;
background-color:#BFBFBF;
box-shadow: 0px 0px 5px 1px #999;
border-radius:10px;
text-align:center;
padding:2% 2% 2% 2%;
margin-bottom:2%;
}

.setup-admin textarea{
width:800px;
height:300px;}

.setup-admin2{
float:right;
width:200px;
height:40px;

}
/*

Setup 

*/
#setup-container a{
text-decoration: none;
color:#000000;
}
#setup-container a:visited{
color:#1E90FF;
text-decoration: none;
}

#setup-container a:hover{
background-color:#FFFFFF;
text-decoration: none;
}

#setup-container{
float:left;
width:70%;
height:auto;
margin-left:15%;
margin-top:100px;
padding-right:2%;
padding-left:2%;
padding-top:2%;
box-shadow: 0px 0px 5px 1px #999;
border-radius:10px;
background-color:#BFBFBF;

#setup-textarea{
padding:5px 15px; 
background:#ccc; 
border:0 none;
cursor:text;
font-family: Comfortaa;
box-shadow: 0px 0px 5px 1px #999;
height:100px;
}
}
";
?>
