<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308071746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tank ADD nation_id INT NOT NULL');
        $this->addSql('ALTER TABLE tank ADD CONSTRAINT FK_AD12B739AE3899 FOREIGN KEY (nation_id) REFERENCES nation (id)');
        $this->addSql('CREATE INDEX IDX_AD12B739AE3899 ON tank (nation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tank DROP FOREIGN KEY FK_AD12B739AE3899');
        $this->addSql('DROP INDEX IDX_AD12B739AE3899 ON tank');
        $this->addSql('ALTER TABLE tank DROP nation_id');
    }
}
