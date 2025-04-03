<DOCTYPE html>
<html>
    <head>
        <title>{{ title }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href={{ CSSHref ~ "/main/style.css" }}>
    </head>    
    <body>
        {% include "header.tpl" %}
        <main class="main">
            <p class=time>{{"now"|date("H:i:s")}}</p>
            <div id="header">
                {% include "auth-template.tpl" %}
            </div>
            <div class="contant">
                {% include "sidebar.tpl" %}
                {% include content_template_name %}
            </div>
        </main>
        {% include "footer.tpl" %}
        <script src="/JS/main.js"></script>
        <script src="/JS/timescript.js"></script>
    </body>
</html> 