<?php declare(strict_types=1);

namespace CronixAvantLink;

use Shopware\Core\Framework\Plugin;
use Shopware\Core\Framework\Plugin\Context\ActivateContext;
use Shopware\Core\Framework\Plugin\Context\DeactivateContext;
use Shopware\Core\Framework\Plugin\Context\InstallContext;
use Shopware\Core\Framework\Plugin\Context\UninstallContext;
use Shopware\Core\Framework\Plugin\Context\UpdateContext;

/**
 * CronixAvantLink Plugin
 * 
 * Professional AvantLink affiliate tracking integration with flexible script injection capabilities.
 * This plugin provides seamless integration with AvantLink affiliate tracking system.
 * 
 * @package CronixAvantLink
 * @author Suprabhat Joshi
 * @version 1.0.0
 * @copyright Copyright © 2025 Cronix Digital
 */
class CronixAvantLink extends Plugin
{
    /**
     * Plugin installation method
     * 
     * This method is called when the plugin is installed for the first time.
     * Use this method to create database tables, default configuration,
     * or any other setup tasks required for the plugin to function.
     * 
     * @param InstallContext $installContext The installation context
     * @return void
     */
    public function install(InstallContext $installContext): void
    {
        // Do stuff such as creating a new payment method
        // Initialize plugin configuration
        // Create necessary database tables
        // Set up default plugin settings
    }

    /**
     * Plugin uninstallation method
     * 
     * This method is called when the plugin is being uninstalled.
     * Clean up all plugin data, configurations, and database entries.
     * Check if user data should be kept based on uninstall context.
     * 
     * @param UninstallContext $uninstallContext The uninstallation context
     * @return void
     */
    public function uninstall(UninstallContext $uninstallContext): void
    {
        // Call parent uninstall method first
        parent::uninstall($uninstallContext);

        // Check if user data should be preserved during uninstallation
        if ($uninstallContext->keepUserData()) {
            return;
        }

        // Remove or deactivate the data created by the plugin
        // Clean up database tables
        // Remove configuration settings
        // Clean up any created files or directories
    }

    /**
     * Plugin activation method
     * 
     * This method is called when the plugin is activated.
     * Use this method to enable plugin functionality, activate services,
     * or perform any tasks that should happen when the plugin becomes active.
     * 
     * @param ActivateContext $activateContext The activation context
     * @return void
     */
    public function activate(ActivateContext $activateContext): void
    {
        // Activate entities, such as a new payment method
        // Or create new entities here, because now your plugin is installed and active for sure
        // Enable plugin services
        // Activate event listeners
        // Initialize plugin functionality
    }

    /**
     * Plugin deactivation method
     * 
     * This method is called when the plugin is deactivated.
     * Use this method to disable plugin functionality, deactivate services,
     * or perform cleanup tasks while preserving user data.
     * 
     * @param DeactivateContext $deactivateContext The deactivation context
     * @return void
     */
    public function deactivate(DeactivateContext $deactivateContext): void
    {
        // Deactivate entities, such as a new payment method
        // Or remove previously created entities
        // Disable plugin services
        // Deactivate event listeners
        // Clean up temporary data
    }

    /**
     * Plugin update method
     * 
     * This method is called when the plugin is being updated to a new version.
     * Use this method to perform version-specific updates, migrate data,
     * or update configurations that are not database-related.
     * 
     * @param UpdateContext $updateContext The update context
     * @return void
     */
    public function update(UpdateContext $updateContext): void
    {
        // Update necessary stuff, mostly non-database related
        // Migrate configuration settings
        // Update file structures
        // Handle version-specific changes
        // Clear caches if needed
    }

    /**
     * Post-installation method
     * 
     * This method is called after the plugin has been successfully installed.
     * Use this method for tasks that should happen after the installation
     * process is complete, such as sending notifications or logging events.
     * 
     * @param InstallContext $installContext The installation context
     * @return void
     */
    public function postInstall(InstallContext $installContext): void
    {
        // Post-installation tasks
        // Send installation notifications
        // Log installation events
        // Initialize post-install configurations
    }

    /**
     * Post-update method
     * 
     * This method is called after the plugin has been successfully updated.
     * Use this method for tasks that should happen after the update
     * process is complete, such as clearing caches or sending notifications.
     * 
     * @param UpdateContext $updateContext The update context
     * @return void
     */
    public function postUpdate(UpdateContext $updateContext): void
    {
        // Post-update tasks
        // Clear relevant caches
        // Send update notifications
        // Log update events
        // Finalize update process
    }

    /**
     * Get view paths for template rendering
     * 
     * This method returns an array of paths where the plugin's view templates
     * are located. These paths are used by Shopware's template engine to
     * locate and render the plugin's custom templates.
     * 
     * @return array Array of view paths
     */
    public function getViewPaths(): array
    {
        // Return array of view template paths
        // These paths will be used by Shopware's template engine
        // to locate plugin-specific templates and views
        return ['Resources/views'];
    }
}