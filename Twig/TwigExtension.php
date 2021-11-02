<?php

namespace BCC\CronManagerBundle\Twig;

class TwigExtension extends \Twig_Extension implements \Twig_Extension_GlobalsInterface
{
    /**
     * @var array
     */
    protected $wwwUser;
    
    public function __construct($logDir, $projectDir)
    {
        if (function_exists('posix_getpwuid')) {
            $this->wwwUser = posix_getpwuid(posix_geteuid());
        }
        else {
            $this->wwwUser = array(
                'name' => get_current_user(),
                'dir'  => '-',
            );
        }
    }
    
    public function getGlobals()
    {
        return array(
            'wwwUser'        => $this->wwwUser,
        );
    }

    public function getName() {
        return 'bcc-cron-manager';
    }
}
