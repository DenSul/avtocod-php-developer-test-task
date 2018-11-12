<?php

namespace App\Console\Commands;

use App\Repository\ManageAdministratorsRepository;
use App\Service\ManageAdministratorsService;
use Illuminate\Console\Command;

class ManageAdministrators extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'manage:admin {user?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Управление администраторами';

    /** @var ManageAdministratorsRepository */
    protected $repository;
    /** @var ManageAdministratorsService */
    protected $service;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ManageAdministratorsRepository $manageAdministratorsRepository)
    {
        parent::__construct();

        $this->repository = $manageAdministratorsRepository;
        $this->service    = new ManageAdministratorsService($this->repository);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ( !$this->argument('user') )
        {
            $login = $this->anticipate('Введите логин пользователя', $this->repository->all()->pluck('login')->toArray());
        }
        else
        {
            $login = $this->argument('user');
        }


        $user = $this->repository->findByLogin($login);

        if ( $user->is_admin ) {
            $this->info('Выбранный юзер ЯВЛЯЕТСЯ администратором');
        }
        else {
            $this->line('Выбранный НЕ является администратором');
        }

        $role_id = $this->choice('Какие права дать?', ['Администратор', 'Простой смертный']);

        if ( $role_id == 'Администратор' ) {
            $god_mode = 1;
        } else {
            $god_mode = 0;
        }

        $this->service->setRole($user, $god_mode);
        $this->info('Готово!');
    }
}
