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
class __TwigTemplate_22965822f5905b3e557863ba0a2ade81 extends Template
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

<link rel=\"stylesheet\" type=\"text/css\" href=\"/src/Views/CSS/header/header.css? v=<?= filemtime('/src/Views/CSS/header/header.css')?>\">";
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
    public function getDebugInfo(): array
    {
        return array (  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "header.tpl", "/data/mysite.local/src/Views/header.tpl");
    }
}
