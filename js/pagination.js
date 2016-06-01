function pagination(page){
    console.log("1");
    // document.getElementById("huisdata").innerText = "";
    console.log("2");
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            console.log("1");
            document.getElementById("pagination").innerHTML=xmlhttp.responseText;
            console.log("2");
        }
    }
    xmlhttp.open("GET","getResults.php?page="+ page,true);
    xmlhttp.send();
}