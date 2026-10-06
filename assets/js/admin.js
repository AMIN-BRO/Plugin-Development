(function($) {
    'use strict';

    /**
     * Plugin Development Admin Scripts
     */
    const PluginDevAdmin = {
        init: function() {
            this.bindEvents();
            this.loadSettings();
        },

        bindEvents: function() {
            $(document).on('click', '.plugin-dev-button', this.handleButtonClick.bind(this));
            $(document).on('change', '.plugin-dev-setting', this.handleSettingChange.bind(this));
        },

        handleButtonClick: function(e) {
            e.preventDefault();
            const button = $(e.target);
            const action = button.data('action');
            console.log('Button clicked:', action);
            this.showNotification('Action executed: ' + action, 'success');
        },

        handleSettingChange: function(e) {
            const setting = $(e.target);
            const key = setting.data('key');
            const value = setting.val();
            console.log('Setting changed:', key, '=', value);
            this.saveSetting(key, value);
        },

        saveSetting: function(key, value) {
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'plugin_dev_save_setting',
                    key: key,
                    value: value,
                    nonce: $('#plugin-dev-nonce').val()
                },
                success: function(response) {
                    console.log('Setting saved successfully');
                },
                error: function(error) {
                    console.error('Error saving setting:', error);
                }
            });
        },

        loadSettings: function() {
            console.log('Loading plugin settings...');
        },

        showNotification: function(message, type) {
            const notificationClass = 'plugin-dev-status status-' + type;
            const notification = $('<div class="' + notificationClass + '">' + message + '</div>');
            $('body').prepend(notification);
            setTimeout(function() {
                notification.fadeOut(function() {
                    $(this).remove();
                });
            }, 3000);
        }
    };

    $(document).ready(function() {
        PluginDevAdmin.init();
    });

})(jQuery);
