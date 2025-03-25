<DOCTYPE html>
<html>
    <head>
        <title>{{ title }}</title>
    </head>
    <link rel="stylesheet" type="text/css" href={{ CSSHref ~ "/main/main.css" }}>
    <body>
        {% include "header.tpl" %}
        <main class="main">
            <p class=time>{{"now"|date("H:i:s")}}</p>
            <div class="contant">
                {% include "sidebar.tpl" %}
                {% include content_template_name %}
            </div>
        </main>
        {% include "footer.tpl" %}
        <script src="/src/Views/JS/timescript.js"></script>
    </body>
</html>