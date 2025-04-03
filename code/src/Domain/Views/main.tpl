<DOCTYPE html>
<html class="h-100">
    <head>
        <title>{{ title }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
        <script
            src="https://code.jquery.com/jquery-3.6.3.js"
            integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
            crossorigin="anonymous">
        </script>
        <link rel="stylesheet" type="text/css" href={{ CSSHref ~ "/main/style.css" }}>
    </head>    
    <body class="h-100 d-flex flex-column">
        {% include "header.tpl" %}
        <main class="main flex-shrink-0">
            <div class="container">
                <p class=time>{{"now"|date("H:i:s")}}</p>
                <div class="contant content-template">
                    {% include "sidebar.tpl" %}
                    {% include content_template_name %}
                </div>
            </div>
        </main>
        {% include "footer.tpl" %}
        <script src="/JS/main.js"></script>
        <script src="/JS/timescript.js"></script>
    </body>
</html> 