function changeColorScheme(o) {
    var e;
    switch (o) {
        case "basic":
            e = ".console-user,body{color:#fff}.console-os{color:grey}.console-pwd{color:#fff}";
            break;
        case "man":
            e = "body{color:#6195e8}.console-user{color:red}.console-os{color:#00f}.console-pwd{color:#fff}";
            break;
        default:
            e = "body{color:#36ed39}.console-user{color:#2c82b7}.console-os{color:#209b23}.console-pwd{color:#d1bc1d}"
    }
    document.getElementById("color-scheme-css").innerHTML = e
}