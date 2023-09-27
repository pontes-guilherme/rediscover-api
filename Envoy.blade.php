@servers(['main' => 'ubuntu@api.rediscoverapp.tech'])

@setup
$repository = 'git@github.com:pontes-guilherme/rediscover-api.git';
$releases_dir = '/var/www/app/releases';
$app_dir = '/var/www/app';
$release = date('YmdHis');
$new_release_dir = $releases_dir .'/'. $release;
@endsetup

@story('deploy', ['on' => [$server]])
clone_repository
run_composer
{{--    build_assets--}}
update_symlinks
@endstory

@task('clone_repository')
echo 'Cloning repository'
[ -d {{ $releases_dir }} ] || mkdir {{ $releases_dir }}
git clone --depth 1 {{ $repository }} {{ $new_release_dir }}
@endtask

@task('run_composer')
echo "Starting deployment ({{ $release }})"
cd {{ $new_release_dir }}
composer install --prefer-dist -q -o
@endtask

@task('update_symlinks')
echo "Linking storage directory"
ln -nfs {{$new_release_dir}}/storage/app/public {{$new_release_dir}}/public/storage
rm -rf {{ $new_release_dir }}/storage
ln -nfs {{ $app_dir }}/shared/storage {{ $new_release_dir }}/storage

echo 'Linking .env file'
ln -nfs {{ $app_dir }}/shared/.env {{ $new_release_dir }}/.env

echo 'Linking current release'
ln -nfs {{ $new_release_dir }} {{ $app_dir }}/current
@endtask
