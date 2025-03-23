<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* errorPage.tpl */
class __TwigTemplate_59b8d5746a4e6ab0f2aded6f1e5dc6a5 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<DOCTYPE html>
<html>
    <head>
        <title>Error 404</title>
    </head>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"/src/Views/CSS/main/style.css\">
    <body>
        ";
        // line 8
        yield from $this->loadTemplate("header.tpl", "errorPage.tpl", 8)->unwrap()->yield($context);
        // line 9
        yield "        <main class=\"main\">
                <h1>Error 404 - Not Found</h1>
            </div>
        </main>
        ";
        // line 13
        yield from $this->loadTemplate("footer.tpl", "errorPage.tpl", 13)->unwrap()->yield($context);
        // line 14
        yield "    </body>
</html>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "errorPage.tpl";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  61 => 14,  59 => 13,  53 => 9,  51 => 8,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "errorPage.tpl", "/data/mysite.local/src/Views/errorPage.tpl");
    }
}
