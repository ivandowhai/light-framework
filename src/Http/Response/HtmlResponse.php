<?php

declare(strict_types=1);

namespace Light\Http\Response;

use Light\ {
    App,
    Config\Config
};

class HtmlResponse implements Response
{
    /**
     * HtmlResponse constructor.
     *
     * @param  mixed[]  $data
     * @param  string|null  $template
     */
    public function __construct(
        private array $data = [],
        private ?string $template = null
    )
    {
        if (null === $this->template) {
            $this->template = App::PROJECT_PATH
                . Config::getInstance()->get('app', 'testTemplate');
        }
    }

    public function handle() : void
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
