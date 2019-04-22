<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190422094624 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE aand_erecord ADD department_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE aand_erecord ADD CONSTRAINT FK_E8A7F781AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
        $this->addSql('CREATE INDEX IDX_E8A7F781AE80F5DF ON aand_erecord (department_id)');
        $this->addSql('ALTER TABLE department ADD a_and_erecord_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE department ADD CONSTRAINT FK_CD1DE18A186C185E FOREIGN KEY (a_and_erecord_id) REFERENCES aand_erecord (id)');
        $this->addSql('CREATE INDEX IDX_CD1DE18A186C185E ON department (a_and_erecord_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE aand_erecord DROP FOREIGN KEY FK_E8A7F781AE80F5DF');
        $this->addSql('DROP INDEX IDX_E8A7F781AE80F5DF ON aand_erecord');
        $this->addSql('ALTER TABLE aand_erecord DROP department_id');
        $this->addSql('ALTER TABLE department DROP FOREIGN KEY FK_CD1DE18A186C185E');
        $this->addSql('DROP INDEX IDX_CD1DE18A186C185E ON department');
        $this->addSql('ALTER TABLE department DROP a_and_erecord_id');
    }
}
