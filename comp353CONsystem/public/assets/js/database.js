
//database.js script
function getData(reqType, str) {
  var xhttp;
  if (reqType == ""){
      reqType = "Example";
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "database.php?q="+reqType+str, true);
  xhttp.send();
}
//
function setData(reqType, formId) {
    var xhttp;
    if (reqType == ""){
        reqType = "Example";
    }
    str = "q="+reqType+"&";
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
      document.getElementById(formId).innerHTML = this.responseText;
      }
    };
    xhttp.open("POST", "database.php", true);
    xhttp.send(str+document.getElementById(formId).serialize());
  }