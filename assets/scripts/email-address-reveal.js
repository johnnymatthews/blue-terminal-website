function toggleEmail() {
    var o = "john@mohnjatthews.com";
    document.getElementById("email-address-reveal").innerHTML != '<a href="mailto:' + o + '">' + o + "</a>" ? document.getElementById("email-address-reveal").innerHTML = '<a href="mailto:' + o + '">' + o + "</a>" : document.getElementById("email-address-reveal").innerHTML = "&nbsp;"
}