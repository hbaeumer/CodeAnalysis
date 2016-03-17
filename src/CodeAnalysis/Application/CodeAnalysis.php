<?php
/**
 * Created by PhpStorm.
 * User: heiner
 * Date: 16.03.16
 * Time: 21:57
 */

namespace CodeAnalysis\Application;


use CodeAnalysis\Console\Command\InitCommand;
use Symfony\Component\Console\Application;

class CodeAnalysis extends Application
{
    protected function getDefaultCommands() {
    return array_merge(
        parent::getDefaultCommands(),
        [
            new InitCommand(),
        ]
    );
}


}
{

}