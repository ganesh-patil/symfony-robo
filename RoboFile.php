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
    
    public function gitPush() {
         $this->taskGitStack()
 	->stopOnFail()
 	->add('-A')
 	->commit('adding current by robo ')
 	->push('origin','master')
 	->run();
     }
}
