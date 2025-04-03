<?php

namespace Geekbrains\Application1\Application;

use Exception;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Render
{
    private string $viewFolder = 'src/Domain/Views';
    private FilesystemLoader $loader;
    private Environment $environment;

    public function __construct()
    {
        $this->loader = new FilesystemLoader($_SERVER['DOCUMENT_ROOT'] . "/../" .  $this->viewFolder);
        $this->environment = new Environment($this->loader, [
            'cache' => $_SERVER['DOCUMENT_ROOT'] . '/../cache/'
        ]);
    }

    public function renderPage(string $contentTemplateName = 'page-index.tpl', array $templateVariables = [])
    {
        $CSSFolder = '/CSS';
        $template = $this->environment->load('main.tpl');
        $templateVariables['content_template_name'] = $contentTemplateName;
        $templateVariables['CSSHref'] = $CSSFolder;
        if (isset($_SESSION['user_name'])) {
            $username = null;

            if (isset($_SESSION["user_name"])) {
                $username = $_SESSION["user_name"];
            } else {
                $username = 'Пользователь';
            }
            $templateVariables['user_authorized'] = true;
            $templateVariables['user_name'] = $username;

        }
        return $template->render($templateVariables);
    }


    public function renderExeptionPage(Exception $e, string $exeptionPage = 'exeptionPage.tpl')
    {
        $CSSFolder = $this->viewFolder . '/CSS';
        $template = $this->environment->load('main.tpl');
        $templateVariables['content_template_name'] = $exeptionPage;
        $templateVariables['message'] = $e->getMessage();
        $templateVariables['CSSHref'] = $CSSFolder;
        return $template->render($templateVariables);
    }

    public function errorRender()
    {
        $CSSFolder = $this->viewFolder . '/CSS';
        $template = $this->environment->load('errorPage.tpl');
        $templateVariables['CSSHref'] = $CSSFolder;
        return $template->render($templateVariables);
    }

    /**
     * Generation template with form
     * @param string $contentTemplateName - template name (tpl)
     * @param array $templateVariables
     * @return string render
     */
    public function renderPageWithForm(string $contentTemplateName = 'page-index.tpl', array $templateVariables = [])
    {
        // Генерируется рандомный набор байт, который потом преобразуется в строку с помощью bin2hex
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        $templateVariables['csrf_token'] = $_SESSION['csrf_token'];
        return $this->renderPage($contentTemplateName, $templateVariables);
    }
}