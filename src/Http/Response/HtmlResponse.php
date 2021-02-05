<?php

declare(strict_types=1);

namespace Light\Http\Response;

use Light\Config\Config;

class HtmlResponse implements Response
{
    public function __construct(
        private array $data = [],
        private ?string $template = null
    )
    {
        if (null === $this->template) {
            $this->template = PROJECT_PATH
                . Config::getInstance()->get('app', 'testTemplate');
        }
    }

    public function handle()
    {
        $data = $this->data;
        ob_start();
        require_once $this->template;
        echo ob_get_clean();
    }

    public function getTemplate(): ?string
    {
        return $this->template;
    }

    public function setTemplate(string $template): void
    {
        $this->template = $template;
    }
}
