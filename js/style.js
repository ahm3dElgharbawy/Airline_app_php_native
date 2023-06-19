function myFunction() {
    var x = document.getElementById("topnavid");
    if (x.className === "navbar") {
      x.className += " responsive";
    } else {
      x.className = "navbar";
    }
  }