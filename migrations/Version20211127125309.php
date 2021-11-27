<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211127125309 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE eexchange_rate (id INT AUTO_INCREMENT NOT NULL, base_id INT DEFAULT NULL, type_id INT DEFAULT NULL, created DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', value NUMERIC(20, 6) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_3FE3C1AA6967DF41 (base_id), INDEX IDX_3FE3C1AAC54C8C93 (type_id), UNIQUE INDEX idx_rate (created, base_id, type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eexchange_type (id INT AUTO_INCREMENT NOT NULL, identity VARCHAR(255) NOT NULL, UNIQUE INDEX idx_identity (identity), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE eexchange_rate ADD CONSTRAINT FK_3FE3C1AA6967DF41 FOREIGN KEY (base_id) REFERENCES eexchange_type (id)');
        $this->addSql('ALTER TABLE eexchange_rate ADD CONSTRAINT FK_3FE3C1AAC54C8C93 FOREIGN KEY (type_id) REFERENCES eexchange_type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eexchange_rate DROP FOREIGN KEY FK_3FE3C1AA6967DF41');
        $this->addSql('ALTER TABLE eexchange_rate DROP FOREIGN KEY FK_3FE3C1AAC54C8C93');
        $this->addSql('DROP TABLE eexchange_rate');
        $this->addSql('DROP TABLE eexchange_type');
    }
}
