<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191118204734 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, symbol VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_account (role_id INT NOT NULL, account_id INT NOT NULL, INDEX IDX_C1FBF35FD60322AC (role_id), INDEX IDX_C1FBF35F9B6B5FBA (account_id), PRIMARY KEY(role_id, account_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE permission (id INT AUTO_INCREMENT NOT NULL, role_id INT DEFAULT NULL, capability VARCHAR(255) NOT NULL, INDEX IDX_E04992AAD60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE account (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, is_active TINYINT(1) DEFAULT \'0\' NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_7D3656A4F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE role_account ADD CONSTRAINT FK_C1FBF35FD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_account ADD CONSTRAINT FK_C1FBF35F9B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE permission ADD CONSTRAINT FK_E04992AAD60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE role_account DROP FOREIGN KEY FK_C1FBF35FD60322AC');
        $this->addSql('ALTER TABLE permission DROP FOREIGN KEY FK_E04992AAD60322AC');
        $this->addSql('ALTER TABLE role_account DROP FOREIGN KEY FK_C1FBF35F9B6B5FBA');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE role_account');
        $this->addSql('DROP TABLE permission');
        $this->addSql('DROP TABLE account');
    }
}
