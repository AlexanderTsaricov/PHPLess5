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

/* header.tpl */
class __TwigTemplate_470e1b460dd327f3a994b39e4f82966e extends Template
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
        yield "<header class=\"header\">
    <div class=\"header_box\">
        <p>Это шапка сайта</p>
        <a href=\"/\">Главная</a>
        <a href=\"/user/index/\">Пользователи</a>
    </div>
    <div class=\"header_box\"><p>Это тоже  шапка сайта</p></div>
</header>

<link rel=\"stylesheet\" type=\"text/css\" href=";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($context["CSSHref"] ?? null) . "/header/header.css"), "html", null, true);
        yield ">";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "header.tpl";
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
        return array (  53 => 10,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "header.tpl", "/data/mysite.local/src/Domain/Views/header.tpl");
    }
}
