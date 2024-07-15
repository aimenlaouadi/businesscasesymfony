<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240628103711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE staff ADD staffstatus_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE staff ADD CONSTRAINT FK_426EF3926769E573 FOREIGN KEY (staffstatus_id) REFERENCES staff_status (id)');
        $this->addSql('CREATE INDEX IDX_426EF3926769E573 ON staff (staffstatus_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE staff DROP FOREIGN KEY FK_426EF3926769E573');
        $this->addSql('DROP INDEX IDX_426EF3926769E573 ON staff');
        $this->addSql('ALTER TABLE staff DROP staffstatus_id');
    }
}
