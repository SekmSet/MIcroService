<?php

namespace App\Migration;

use Illuminate\Database\Capsule\Manager as Capsule;
use Phinx\Migration\AbstractMigration;

class Migration extends AbstractMigration {
    /** @var \Illuminate\Database\Capsule\Manager $capsule */
    public $capsule;
    /** @var \Illuminate\Database\Schema\Builder $capsule */
    public $schema;

    public function init() {
        $this->capsule = new Capsule;
        $this->capsule->addConnection([
            'driver'    => 'mysql',
            'host' => $_ENV['DB_HOST'],
            'port'      => 3306,
            'database' => $_ENV['DB'],
            'username' => $_ENV['DB_USERNAME'],
            'password' => $_ENV['DB_PWD'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ]);

        $this->capsule->bootEloquent();
        $this->capsule->setAsGlobal();
        $this->schema = $this->capsule->schema();
    }
}