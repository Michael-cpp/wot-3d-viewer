<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308141334 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tank DROP FOREIGN KEY FK_AD12B739AE3899');
        $this->addSql('DROP TABLE tank');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tank (id INT AUTO_INCREMENT NOT NULL, nation_id INT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, level SMALLINT NOT NULL, INDEX IDX_AD12B739AE3899 (nation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE tank ADD CONSTRAINT FK_AD12B739AE3899 FOREIGN KEY (nation_id) REFERENCES nation (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
