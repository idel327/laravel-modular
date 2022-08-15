<?php

namespace Idel\Modular\Traits;

use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use Str;

trait NovaSupport
{
    /**
     * Boot laravel nova.
     *
     * To use this feature, the Laravel Nova package must be installed first, 
     * then set the supportLaravelNova option to true in config/laravel-modules.php
     * 
     * @param string $diskName
     * @return void
     */
    protected function bootLaravelNova(
    	bool $hasResources  = true,
    	bool $hasCards      = false,
    	bool $hasDashboards = false,
    	bool $hasTools      = false,
    	bool $hasJs         = false,
    	bool $hasCss        = false,
    	string $assetDir    = '',
    )
    {
    	if(config('laravel-modules.supportLaravelNova')) :
	    	$moduleDir = module_path($this->moduleName);
	    	$moduleUcFirst = Str::ucfirst($this->moduleName);

	        Nova::serving(function (ServingNova $event) use($hasResources , $hasCards , $hasDashboards , $hasTools , $hasJs , $hasCss , $assetDir , $moduleDir , $moduleUcFirst) {
	        	if($hasResources) :
	            	Nova::resources(getNovaResources("{$moduleDir}/{$this->moduleName}/src/Resources" , "App/{$moduleUcFirst}"));
	        	endif;
	        	if($hasCards) :
	            	Nova::cards($this->novaCards());
	        	endif;
	        	if($hasDashboards) :
	            	Nova::dashboards($this->novaDashboards());
	        	endif;
	        	if($hasTools) :
	            	Nova::tools($this->novaTools());
	        	endif; 	
	        	if($hasJs) :
	            	Nova::script($this->moduleName, asset("$assetDir/{$this->moduleName}.js"));
	        	endif;
	        	if($hasCss) :
	            	Nova::style($this->moduleName, asset("$assetDir/{$this->moduleName}.css"));
	        	endif;
	        });
    	endif;

    }

    /**
     * Here you can register your nova cards
     */
    protected function novaCards()
    {
        return [];
    }

    /**
     * Here you can register your nova dashboards
     */
    protected function novaDashboards()
    {
        return [];
    }

    /**
     * Here you can register your nova tools connected to module
     */
    protected function novaTools()
    {
        return [];
    }
}