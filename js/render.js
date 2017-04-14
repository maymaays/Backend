(function () {
    var file = file || "../README.md";
    var reader = new stmd.DocParser();
    var writer = new stmd.HtmlRenderer();
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            display(xhr);
        }
    };

    function display(xhr) {
        var parsed = reader.parse(xhr.responseText);
        var content = writer.renderBlock(parsed);

        document.title = "API Page (Backend)";
        document.getElementsByTagName('body')[0].innerHTML = content;
    }

    xhr.open('GET', file);
    xhr.send();
})();

