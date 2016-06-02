<?php

namespace Grav\Plugin;

use Grav\Common\Plugin;

class UserHelpPlugin extends Plugin
{
    protected $route = 'user-help';

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0],
        ];
    }

    /**
     * Enable only if url matches to the configuration.
     */
    public function onPluginsInitialized()
    {
        if (!$this->isAdmin()) {
            return;
        }

        /** @var Uri $uri */
        $uri = $this->grav['uri'];
        $this->enable([
            'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0],
            'onAdminMenu'         => ['onAdminMenu', 0],
        ]);

    }

    /**
     * Add plugin templates path
     */
    public function onTwigTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/admin/templates';
    }

    /**
     * Add navigation item to the admin plugin
     */
    public function onAdminMenu()
    {
        $this->grav['twig']->plugins_hooked_nav['PLUGIN_HELP_INFO.PLUGIN_MENU_TITLE'] = [
            'route' => $this->route,
            'icon'  => 'fa-question',
        ];
    }
}
