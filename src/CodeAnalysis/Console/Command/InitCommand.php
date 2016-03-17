<?php
/**
 * Created by PhpStorm.
 * User: heiner
 * Date: 16.03.16
 * Time: 21:59
 */

namespace CodeAnalysis\Console\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class InitCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('init')
            ->setDescription('initalize the condanalysis')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $question = new Question('ProjectName: ', 'Analysthis');

        $name = $helper->ask($input, $output, $question);
        $output->writeln('You have just selected: '.$name);
        $path = $helper->ask($input, $output, new Question('root: ['.getcwd().']', getcwd()));

        $this->copyBuildXML($path);
        $this->copyPhpDoxXml($path);
        $this->copyTemplates($path);
    }

    private function copyBuildXML($path)
    {
        $dist = __DIR__.'/../../../../data';
        copy($dist.'/build.xml.dist', $path.'/build.xml');
    }

    private function copyPhpDoxXml($path)
    {
        $dist = __DIR__.'/../../../../data';
        copy($dist.'/phpdox.xml', $path.'/build/configs/phpdox.xml');
    }

    private function copyTemplates($path)
    {
        $dist = __DIR__.'/../../../../data/templates';
        $this->recurse_copy($dist, $path.'/build/templates');
    }

    private function recurse_copy($src,$dst) {

        $dir = opendir($src);
        @mkdir($dst);
        while(false !== ( $file = readdir($dir)) ) {
            var_dump($file);
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    $this->recurse_copy($src . '/' . $file,$dst . '/' . $file);
                }
                else {
                    var_dump($src . '/' . $file.'=>'.$dst . '/' . $file);
                    copy($src . '/' . $file,$dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }


}