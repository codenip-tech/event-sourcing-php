<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240702211415 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creates `Account` and `Entry` tables and its relationships';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE account (id CHAR(36) NOT NULL, iban CHAR(24) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entry (id CHAR(36) NOT NULL, account_id CHAR(36) NOT NULL, amount INT NOT NULL, occurred_on DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_2B219D709B6B5FBA (account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entry ADD CONSTRAINT FK_2B219D709B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE entry DROP FOREIGN KEY FK_2B219D709B6B5FBA');
        $this->addSql('DROP TABLE account');
        $this->addSql('DROP TABLE entry');
    }
}
