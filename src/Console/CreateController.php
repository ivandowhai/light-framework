<?php

declare(strict_types=1);

namespace Light\Console;

use Light\App;

class CreateController
{
    private string $controllersDir;

    public function __construct() {
        $this->controllersDir = App::getProjectPath()
            . DIRECTORY_SEPARATOR . 'App'
            . DIRECTORY_SEPARATOR . 'Controllers';
    }

    public function __invoke(...$arguments) : void
    {
        if (!isset($arguments[0])) {
            throw new ConsoleException('Name is required');
        }
        $name = $arguments[0];

        if (!preg_match('/^[A-Za-z]+$/', $name)) {
            throw new ConsoleException('Name is invalid');
        }

        if (!dir($this->controllersDir)) {
            mkdir($this->controllersDir);
        }

        $code = <<<END
<?php

namespace App\Controllers;

use Light\Http\ {
    Controllers\BaseController,
    Request,
    Response\Response
};

class $name extends BaseController {

  public function handle(Request \$request): Response
  {
    
  }
}

END;

        file_put_contents(
            $this->controllersDir . DIRECTORY_SEPARATOR . $name . '.php',
            $code
        );
    }
}
