<?php

final class DataController
{
    public function getPhpVersion()
    {
        return phpversion();
    }

    public function getWordpressVersion()
    {
        return get_bloginfo('version');
    }

    public function getPluginsVersions()
    {
        $versions = array();
        $plugins = get_plugins();

        foreach ($plugins as $plugin) {
            $versions[$plugin['TextDomain']] = $plugin['Version'];
        }

        return $versions;
    }
}
