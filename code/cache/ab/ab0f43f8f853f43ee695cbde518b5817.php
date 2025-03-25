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

/* addUserForm.tpl */
class __TwigTemplate_7c6dcc3b8ddf0472bd384110456e02f9 extends Template
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
        yield "<form action=\"/user/save/\" class=\"addUserForm\">
    <label class=\"addUserForm_label\">Имя нового пользователя</label>
    <input type=\"text\"/ name=\"name\" class=\"addUserForm_input\">
    <label class=\"addUserForm_label\">Фамилия нового пользователя</label>
    <input type=\"text\"/ name=\"lastname\" class=\"addUserForm_input\">
    <label class=\"addUserForm_label\">День рождения нового пользователя</label>
    <input type=\"date\"/ name=\"birthday\" class=\"addUserForm_input\">
    <input type=\"submit\" value=\"Сохранить\" class=\"addUserForm_submit\">
</form>

<link rel=\"stylesheet\" type=\"text/css\" href=";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($context["CSSHref"] ?? null) . "/addUserForm/addUserForm.css"), "html", null, true);
        yield ">";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "addUserForm.tpl";
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
        return array (  54 => 11,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "addUserForm.tpl", "/data/mysite.local/src/Domain/Views/addUserForm.tpl");
    }
}
