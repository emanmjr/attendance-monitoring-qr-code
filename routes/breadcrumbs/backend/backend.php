<?php

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push(__('strings.backend.dashboard.title'), route('admin.dashboard'));
});

Breadcrumbs::for('admin.transaction.index', function ($trail) {
    $trail->push('Transactions', route('admin.transaction.index'));
});

Breadcrumbs::for('frontend.user.account.be.copy', function ($trail) {
    $trail->push('My Account', route('admin.dashboard'));
});

require __DIR__.'/auth.php';
require __DIR__.'/log-viewer.php';
