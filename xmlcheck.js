window.contentType = 'application/xml';

function payload(data) {
    var xml = '<?xml version="1.0" encoding="UTF-8"?>';
    xml += '<likeCheck>';

    for(var pair of data.entries()) {
        var key = pair[0];
        var value = pair[1];

        xml += '<' + key + '>' + value + '</' + key + '>';
    }

    xml += '</likeCheck>';
    return xml;
}

document.getElementById("likeCheck").addEventListener("submit", function(e) {
    checkStock(this.getAttribute("method"), this.getAttribute("action"), new FormData(this));
    e.preventDefault();
});

function checkStock(method, path, data) {
    const retry = (tries) => tries == 0
        ? null
        : fetch(
            path,
            {
                method,
                headers: { 'Content-Type': window.contentType },
                body: payload(data)
            }
          )
            .then(res => res.status === 200
                ? res.text().then(t => isNaN(t) ? t : t + " likes")
                : "Could not fetch like levels!"
            )
            .then(res => document.getElementById("likeCheckResult").innerHTML = res)
            .catch(e => retry(tries - 1));

    retry(3);
}