<?php namespace App\Modules;
 
/**
* ServiceProvider
*
* The service provider for the modules. After being registered
* it will make sure that each of the modules are properly loaded
* i.e. with their routes, views etc.
*
* @author Kamran Ahmed <kamranahmed.se@gmail.com>
* @package App\Modules
*/
class ModulesServiceProvider extends \Illuminate\Support\ServiceProvider
{
   
    public function boot()
    {
      
        $modules = config("module.modules");

        foreach($modules as $key=>$module) {

            
            if(file_exists(__DIR__.'/'.$module.'/routes.php')) {
                include __DIR__.'/'.$module.'/routes.php';
            }

    
            if(is_dir(__DIR__.'/'.$module.'/Views')) {
                $this->loadViewsFrom(__DIR__.'/'.$module.'/Views', $module);
            }
        }

 
    }

    public function register() {}

}

