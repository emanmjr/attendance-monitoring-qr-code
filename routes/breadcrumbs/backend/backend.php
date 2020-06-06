<?php

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push(__('strings.backend.dashboard.title'), route('admin.dashboard'));
});

Breadcrumbs::for('admin.transaction.send', function ($trail) {
    $trail->push('Transactions / Send', route('admin.transaction.send'));
});

Breadcrumbs::for('admin.transaction.receive', function ($trail) {
    $trail->push('Transactions / Receive', route('admin.transaction.receive'));
});

Breadcrumbs::for('admin.transaction.kyc-lookup', function ($trail) {
    $trail->push('Transactions / KYC LOOKUP', route('admin.transaction.receive'));
});

Breadcrumbs::for('frontend.user.account.be.copy', function ($trail) {
    $trail->push('My Account', route('admin.dashboard'));
});

Breadcrumbs::for('admin.mywu.enrollment', function ($trail) {
    $trail->push('MyWU / Enrollment', route('admin.dashboard'));
});

Breadcrumbs::for('admin.mywu.customer', function ($trail) {
    $trail->push('MyWU / Customer', route('admin.dashboard'));
});

Breadcrumbs::for('admin.mywu.das-request', function ($trail) {
    $trail->push('MyWU / DAS Request', route('admin.dashboard'));
});


require __DIR__.'/auth.php';
require __DIR__.'/log-viewer.php';
