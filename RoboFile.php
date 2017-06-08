<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
    // define public methods as command
    public function start() {
         $this->_exec('php bin/console server:start');

    }
    public function composerInstall(){
       $this->taskComposerInstall()->run();
    }
    
    public function gitPush() {
        $this->taskImageMinify('assets/images/*')
    ->to('dist/images/')
    ->run();
        if($this->taskExec('./vendor/bin/simple-phpunit')->run()->wasSuccessful()) 
        {
           $this->taskGitStack()
            ->stopOnFail()
            ->add('-A')
            ->commit('adding current by robo ')
            ->push('origin','master')
            ->run();  
        } 
     }

     public function unitTest() {
           $this->_exec('./vendor/bin/simple-phpunit');
     }
}
