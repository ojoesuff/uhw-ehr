<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190422095447 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE aand_erecord_department (aand_erecord_id INT NOT NULL, department_id INT NOT NULL, INDEX IDX_3A59BDBC95F9F55E (aand_erecord_id), INDEX IDX_3A59BDBCAE80F5DF (department_id), PRIMARY KEY(aand_erecord_id, department_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE aand_erecord_department ADD CONSTRAINT FK_3A59BDBC95F9F55E FOREIGN KEY (aand_erecord_id) REFERENCES aand_erecord (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE aand_erecord_department ADD CONSTRAINT FK_3A59BDBCAE80F5DF FOREIGN KEY (department_id) REFERENCES department (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE aand_erecord_department');
    }
}
