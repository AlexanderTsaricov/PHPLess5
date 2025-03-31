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

/* user-index.tpl */
class __TwigTemplate_0082216643aab35b6b961413f3d3b590 extends Template
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
        yield "

<section>
    <h2>Список пользователей в хранилище</h2>

    <ul class=\"ul\" id=\"navigation\">
        ";
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["users"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 8
            yield "            <li class=ul_li>
                <p>";
            // line 9
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "getUserName", [], "method", false, false, false, 9), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "getUserLastname", [], "method", false, false, false, 9), "html", null, true);
            yield ". День рождения ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "getUserBirthday", [], "method", false, false, false, 9), "d.m.Y"), "html", null, true);
            yield "</p>
                <a href=\"/user/updatingUser/?id=";
            // line 10
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "getUserId", [], "method", false, false, false, 10), "html", null, true);
            yield "\">Обновить данные</a>
                <a href=\"/user/delete/?id=";
            // line 11
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "getUserId", [], "method", false, false, false, 11), "html", null, true);
            yield "\">Удалить пользователя</a>
            </li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['user'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 14
        yield "    </ul>
</section>




<link rel=\"stylesheet\" type=\"text/css\" href=";
        // line 20
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($context["CSSHref"] ?? null) . "/user-index/user-index.css"), "html", null, true);
        yield ">";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "user-index.tpl";
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
        return array (  86 => 20,  78 => 14,  69 => 11,  65 => 10,  57 => 9,  54 => 8,  50 => 7,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "user-index.tpl", "/data/mysite.local/src/Domain/Views/user-index.tpl");
    }
}
