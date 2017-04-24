<?php

try {
		Trusty::registerPermissions();
} catch (PDOException $e) {
    //
}

Trusty::when(['admin/users', 'admin/users/*'], 'manage_users');
Trusty::when(['admin/pages', 'admin/pages/*'], 'manage_pages');
Trusty::when(['admin/articles', 'admin/articles/*'], 'manage_articles');
Trusty::when(['admin/categories', 'admin/categories/*'], 'manage_categories');
Trusty::when(['admin/permissions', 'admin/permissions/*'], 'manage_permissions');
Trusty::when(['admin/roles', 'admin/roles/*'], 'manage_roles');
Trusty::when('admin/settings', 'manage_settings');
Trusty::when(['admin/news', 'admin/news/*'], 'manage_submit_news');
Trusty::when(['admin/contact', 'admin/contact/*'], 'manage_contacts');
Trusty::when(['admin/widgets', 'admin/widgets/*'], 'manage_widgets');
Trusty::when(['admin/menus', 'admin/menus/*'], 'manage_menus');
Trusty::when(['admin/backup', 'admin/backup/*'], 'manage_backup');
Trusty::when(['admin/videos', 'admin/backup/*'], 'manage_videos');
Trusty::when(['admin/news', 'admin/backup/*'], 'manage_news');
