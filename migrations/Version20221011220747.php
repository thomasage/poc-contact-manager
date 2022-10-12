<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221011220747 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create contacts table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            <<<'SQL'
CREATE TABLE `contact` (
  `id` int(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `uuid` binary(16) NOT NULL UNIQUE,
  `name` varchar(255) NOT NULL,
  `registered_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
SQL
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE `contact`');
    }
}
