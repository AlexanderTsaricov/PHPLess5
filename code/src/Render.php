<?php

namespace Geekbrains\Application1;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Render
{
    private string $viewFolder = '/src/Views';
    private FilesystemLoader $loader;
    private Environment $environment;

    public function __construct()
    {
        $this->loader = new FilesystemLoader($_SERVER['DOCUMENT_ROOT'] . $this->viewFolder);
        $this->environment = new Environment($this->loader, [
            'cache' => $_SERVER['DOCUMENT_ROOT'] . '/cache/'
        ]);
    }

    public function renderPage(string $contentTemplateName = 'page-index.tpl', array $templateVariables = [], string $cssHref = "/page-index/page-index.css")
    {
        $baseHref = "/src/Views/CSS";
        $CSSHref = $baseHref . $cssHref;
        $template = $this->environment->load('main.tpl');
        $templateVariables['content_template_name'] = $contentTemplateName;
        $templateVariables['CSSHref'] = $CSSHref;
        return $template->render($templateVariables);
    }

    public function errorRender()
    {
        $CSSHref = "/src/Views/CSS/errorPage/errorPage.css";
        $template = $this->environment->load('errorPage.tpl');
        $templateVariables['CSSHref'] = $CSSHref;
        return $template->render($templateVariables);
    }
}