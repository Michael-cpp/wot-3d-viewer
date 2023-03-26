<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230319114958 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gun (id INT AUTO_INCREMENT NOT NULL, turret_id INT NOT NULL, armor JSON NOT NULL, INDEX IDX_4A9BC55BBE64A79F (turret_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gun ADD CONSTRAINT FK_4A9BC55BBE64A79F FOREIGN KEY (turret_id) REFERENCES turret (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gun DROP FOREIGN KEY FK_4A9BC55BBE64A79F');
        $this->addSql('DROP TABLE gun');
    }
}
