function changeColorScheme(o) {
    var e;
    switch (o) {
        case "basic":
            e = ".console-user,body{color:#fff}body{background-color:#fff}.console-os{color:grey}.console-pwd{color:#fff}";
            break;
        case "man":
            e = "body{color:#6195e8;background-color:#ff0}.console-user{color:red}.console-os{color:#00f}.console-pwd{color:#fff}";
            break;
        default:
            e = "body{color:#36ed39;background-color:#1c1c1c}.console-user{color:#2c82b7}.console-os{color:#209b23}.console-pwd{color:#d1bc1d}"
    }
    document.getElementById("color-scheme-css").innerHTML = e
}