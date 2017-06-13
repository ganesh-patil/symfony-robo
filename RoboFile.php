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
    
    // Task to install dependancy using composer.
    public function composerInstall(){
       $this->taskComposerInstall()->run();
    }
    
    /**
     * git push task 
     */
    public function gitPush() {
        // @Task : Minify all images 
        $this->taskImageMinify('web/images/*')
            ->to('web/minified/')
        ->run();
        
        // @Task : Run PHPunit test cases 
        if($this->taskExec('./vendor/bin/simple-phpunit')->run()->wasSuccessful())  // check all unit test cases are passed 
        {
            // @Task: Once all unit test cases are passed, Push changes on github.
           $this->taskGitStack()
            ->stopOnFail()
            ->add('-A')
            ->commit('adding current by robo ')
            ->push('origin','master')
            ->run();  
        } 
     }

     // Task to run only usit test cases.
     public function unitTest() {
           $this->_exec('./vendor/bin/simple-phpunit');
     }
}
