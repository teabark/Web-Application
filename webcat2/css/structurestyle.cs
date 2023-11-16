body{
    background-color: rgb(237, 240, 239);
    font-display: "times new roman";
    margin: 0;
}
*{
    box-sizing: border-box;
}
/* background colour of the header, and formatting the header in general*/
.header{
    text-align: center;
    padding: 20px;
    background-color: rgb(202, 202, 199);
}
/* background colour of top navigation*/
.topnav{
    background-color: rgb(8, 7, 7);
    overflow: hidden;
}
/* Colour of the text in the top navigation*/
.topnav a{
    color: rgb(245, 245, 245);
    text-decoration: none;
    float:left;
    display: block;
    text-align: left;
    padding: 14px 16px;
}
/* colour of the text in the top navigation when you hover the top navigation*/
.topnav a:hover{
    color: rgb(153, 12, 12);
    text-decoration: none;
    background-color: beige;
}

/* Right-aligned links*/
.topnav-right{
    float:right;
}
.row::after{
    content: "";
    display: block;
    clear: both;
}
.content{
    float: left;
    width: 66.7%;
    padding: 50px;
}
.sidebar{
    float: left;
    width: 33.3%;
    padding: 50px;
}
.footer{
    text-align: center;
    font-size: small;
    color:beige;
    padding: 10px;
    background-color: rgb(37, 37, 37); 
}
@media screen and (max-width: 800px){
 .content, .sidebar{
    width: 100%;   
 }  
} 