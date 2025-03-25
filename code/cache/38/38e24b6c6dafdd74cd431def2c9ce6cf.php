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

/* main.tpl */
class __TwigTemplate_2020567db358feb3078ae6ad4bf1e7a9 extends Template
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
        <title>";
        // line 4
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield "</title>
    </head>
    <link rel=\"stylesheet\" type=\"text/css\" href=";
        // line 6
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($context["CSSHref"] ?? null) . "/main/main.css"), "html", null, true);
        yield ">
    <body>
        ";
        // line 8
        yield from $this->loadTemplate("header.tpl", "main.tpl", 8)->unwrap()->yield($context);
        // line 9
        yield "        <main class=\"main\">
            <p class=time>";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "H:i:s"), "html", null, true);
        yield "</p>
            <div class=\"contant\">
                ";
        // line 12
        yield from $this->loadTemplate("sidebar.tpl", "main.tpl", 12)->unwrap()->yield($context);
        // line 13
        yield "                ";
        yield from $this->loadTemplate(($context["content_template_name"] ?? null), "main.tpl", 13)->unwrap()->yield($context);
        // line 14
        yield "            </div>
        </main>
        ";
        // line 16
        yield from $this->loadTemplate("footer.tpl", "main.tpl", 16)->unwrap()->yield($context);
        // line 17
        yield "        <script src=\"/src/Views/JS/timescript.js\"></script>
    </body>
</html>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "main.tpl";
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
        return array (  78 => 17,  76 => 16,  72 => 14,  69 => 13,  67 => 12,  62 => 10,  59 => 9,  57 => 8,  52 => 6,  47 => 4,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "main.tpl", "/data/mysite.local/src/Domain/Views/main.tpl");
    }
}
