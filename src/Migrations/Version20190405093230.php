<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190405093230 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE appointment (id INT AUTO_INCREMENT NOT NULL, patient_id INT NOT NULL, department_id INT NOT NULL, medical_staff VARCHAR(50) NOT NULL, date DATETIME NOT NULL, status VARCHAR(50) NOT NULL, complete TINYINT(1) NOT NULL, INDEX IDX_FE38F8446B899279 (patient_id), INDEX IDX_FE38F844AE80F5DF (department_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE department (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, department_id INT DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, first_name VARCHAR(100) NOT NULL, middle_names VARCHAR(100) DEFAULT NULL, last_name VARCHAR(100) DEFAULT NULL, address LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', county VARCHAR(100) DEFAULT NULL, eircode VARCHAR(15) DEFAULT NULL, date_created DATETIME NOT NULL, status VARCHAR(20) NOT NULL, priority VARCHAR(20) NOT NULL, tel_no INT DEFAULT NULL, mobile_no INT DEFAULT NULL, INDEX IDX_1ADAD7EBAE80F5DF (department_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F8446B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F844AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBAE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F844AE80F5DF');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EBAE80F5DF');
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F8446B899279');
        $this->addSql('DROP TABLE appointment');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE patient');
    }
}
