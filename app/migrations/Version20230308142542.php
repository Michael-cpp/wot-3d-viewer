<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308142542 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicle ADD nation_id INT NOT NULL');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E486AE3899 FOREIGN KEY (nation_id) REFERENCES nation (id)');
        $this->addSql('CREATE INDEX IDX_1B80E486AE3899 ON vehicle (nation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E486AE3899');
        $this->addSql('DROP INDEX IDX_1B80E486AE3899 ON vehicle');
        $this->addSql('ALTER TABLE vehicle DROP nation_id');
    }
}
