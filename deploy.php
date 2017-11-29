<?php
namespace Deployer;

require 'recipe/common.php';

// Project name
set('application', 'blog_karion');

// Project repository
set('repository', 'git@github.com:karion/blog.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
set('shared_files', ['app/config/sculpin_site_prod.yml']);
set('shared_dirs', []);

// Writable dirs by web server 
set('writable_dirs', []);
set('allow_anonymous_stats', false);

// Hosts
set('default_stage', 'prod');

inventory('hosts.yml');

// Tasks
desc('Run sculpin for prod');
task('deploy:sculpin', function () {
    run('cd {{release_path}} && {{bin/php}} vendor/bin/sculpin  generate --env=prod');
});


desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'deploy:sculpin',
    'cleanup',
    'success'
]);

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
