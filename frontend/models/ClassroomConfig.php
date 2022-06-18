<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\base\Exception;

class ClassroomConfig extends Model
{
    public $config;
    
    public $confighome='config/config.conf';
    
    public function rules()
    {
        return[

            ['config','required'],
        ];
    }

    public function __construct($config=[])
    {
        $this->loadConfig();

        parent::init($config);
    }
    public function loadConfig()
    {
        if(file_exists($this->confighome))
        {
            $this->config=file_get_contents($this->confighome);
            if($this->config=="" || $this->config==null)
            {
                throw new Exception("Configuration file empty or unreadable"); 
            }
        }
        else
        {
            throw new Exception("Configuration file not found or unreadable");
        }

    
    }

    private function configScrumbs()
    {
        $configs=$this->config;

        $configs=explode("#",$configs);
        $configout=[];
        foreach($configs as $index=>$field)
        {
            if($index==0){continue;}
            $fieldout=explode(":",$configs[$index]);
            $configout[trim($fieldout[0])]=explode('|',trim($fieldout[1]));
        }
        return $configout;
    }
    private function configTest($conf)
    {
        $configs=$conf;
        try
        {
        $configs=explode("#",$configs);
        if(!is_array($configs)){throw new Exception("Invalid configuration data");}
        $configout=[];
        foreach($configs as $index=>$field)
        {
            if($index==0){continue;}
            $fieldout=explode(":",$configs[$index]);
            if(!is_array($fieldout)){throw new Exception("Invalid configuration data");}
            $configout[trim($fieldout[0])]=explode('|',trim($fieldout[1]));
        }
        if(!isset($configout['extensions']) || empty($configout['extensions'][0]))
        {
            throw new Exception("Invalid configuration data,file extensions field must be set !");
        }
        }
        catch(\Exception $cf)
        {
            throw $cf;
        }
      
    }
    public function getFileExtensions()
    {
        $configs=$this->configScrumbs();

        if(!isset($configs['extensions']))
        {
            throw new Exception("file extensions not found, check the configuration file at ".$this->confighome);
        }

        return $configs['extensions'];
    }
    public function updateConfig()
    {
        
        if($this->config=="" || $this->config==null)
        {
            throw new Exception("the configuration file cannot be empty as this may affect some system functionalities !"); 
        }
        $this->configTest($this->config);
        if(file_put_contents($this->confighome,$this->config)!=false)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
