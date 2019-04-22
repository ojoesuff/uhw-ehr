<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190422095026 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE aand_erecord ADD department_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE aand_erecord ADD CONSTRAINT FK_E8A7F78164E7214B FOREIGN KEY (department_id_id) REFERENCES department (id)');
        $this->addSql('CREATE INDEX IDX_E8A7F78164E7214B ON aand_erecord (department_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE aand_erecord DROP FOREIGN KEY FK_E8A7F78164E7214B');
        $this->addSql('DROP INDEX IDX_E8A7F78164E7214B ON aand_erecord');
        $this->addSql('ALTER TABLE aand_erecord DROP department_id_id');
    }
}
