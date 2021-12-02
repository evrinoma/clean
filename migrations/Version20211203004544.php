<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211203004544 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE evacation (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, resolver_id INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', dateStart DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', dateFinish DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', status VARCHAR(255) NOT NULL, INDEX IDX_7605D059A76ED395 (user_id), INDEX IDX_7605D059A26B9CA8 (resolver_id), UNIQUE INDEX idx_vacation (user_id, dateStart, dateFinish), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE evacation ADD CONSTRAINT FK_7605D059A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE evacation ADD CONSTRAINT FK_7605D059A26B9CA8 FOREIGN KEY (resolver_id) REFERENCES fos_user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE evacation');
    }
}
