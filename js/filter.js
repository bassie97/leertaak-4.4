/**
 * Created by Bas de Ruiter on 27-5-2016.
 */


function showValVan() {
    var x = document.getElementById("myRangeVan").value;
    console.log(x);
    document.getElementById("van").innerText = "\u20AC" + x;
}

function showValTot() {
    var x = document.getElementById("myRangeTot").value;
    console.log(x);
    document.getElementById("tot").innerText = "\u20AC" + x;
}

function getResults() {
    if (document.getElementById("myRangeVan").value != null) {
        var van = document.getElementById("myRangeVan").value;
    }

    if (document.getElementById("myRangeTot").value != null) {
        var tot = document.getElementById("myRangeTot").value;
    }
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById("results").innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","getResults.php?van="+van+"&tot=" + tot,true);
    xmlhttp.send();
}