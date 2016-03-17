<?php
/**
 * Created by PhpStorm.
 * User: heiner
 * Date: 16.03.16
 * Time: 23:05
 */

namespace CodeAnalysis\Task;


use TheSeer\phpDox\CLIOptions;
use TheSeer\phpDox\Factory;
use TheSeer\phpDox\FileInfo;
use TheSeer\phpDox\Version;

class PhpdoxTask extends \Task
{
    public function main()
    {
        var_dump(getcwd());
        $vars = [
            __FILE__,
            '-f',
            __DIR__.'/../../../data/phpdox.xml',
        ];

        $ref = new \ReflectionClass('\TheSeer\phpDox\Application');
        $filename = $ref->getFileName();
        $path = rtrim($filename, '/src/Application.php');

        var_dump($path);
        $factory = new Factory(
            new FileInfo($path),
            new Version('0.8.2-dev')
        );
        $factory->getCLI()->run(
            new CLIOptions($vars)
        );
    }


}