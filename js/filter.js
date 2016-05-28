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

function showValoppervlakte() {
    var x = document.getElementById("myRangeOppervlakte").value;
    console.log(x);
    var str = "2";
    var result = str.sub();
    document.getElementById("oppervlakte").innerHTML = x + "m<sup>2</sup>";
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

function selectSoortObject(){
    var e = document.getElementById("mySelectSoortObject");
    var value = e.options[e.selectedIndex].value;
    if (value != null) {
        var soort_object = value;
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
    xmlhttp.open("GET","getResults.php?soort_object="+soort_object,true);
    xmlhttp.send();
}

function selectSoortBouw(){
    var e = document.getElementById("mySelectSoortBouw");
    var value = e.options[e.selectedIndex].value;
    if (value != null) {
        var soort_bouw = value;
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
    xmlhttp.open("GET","getResults.php?soort_bouw="+soort_bouw,true);
    xmlhttp.send();
}

function selectAantalKamers(){
    var e = document.getElementById("mySelectAantalKamers");
    var value = e.options[e.selectedIndex].value;
    if (value != null) {
        var aantal_kamers = value;
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
    xmlhttp.open("GET","getResults.php?aantal_kamers="+aantal_kamers,true);
    xmlhttp.send();
}

// function showValoppervlakte(){
//     var e = document.getElementById("myRangeOppervlakte");
//     var value = e.options[e.selectedIndex].value;
//     if (value != null) {
//         var oppervlakte = value;
//     }
//
//     if (window.XMLHttpRequest) {
//         // code for IE7+, Firefox, Chrome, Opera, Safari
//         xmlhttp=new XMLHttpRequest();
//     } else { // code for IE6, IE5
//         xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
//     }
//     xmlhttp.onreadystatechange=function() {
//         if (xmlhttp.readyState==4 && xmlhttp.status==200) {
//             document.getElementById("results").innerHTML=xmlhttp.responseText;
//         }
//     }
//     xmlhttp.open("GET","getResults.php?oppervlakte="+oppervlakte,true);
//     xmlhttp.send();
// }

function getOppervlakte() {
    if (document.getElementById("myRangeOppervlakte").value != null) {
        var oppervlakte = document.getElementById("myRangeOppervlakte").value;
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
    xmlhttp.open("GET","getResults.php?oppervlakte=" + oppervlakte ,true);
    xmlhttp.send();
}
