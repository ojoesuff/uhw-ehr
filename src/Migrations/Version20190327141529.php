<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190327141529 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE appointment (id INT AUTO_INCREMENT NOT NULL, patient_id_id INT NOT NULL, department_id_id INT NOT NULL, medical_staff VARCHAR(255) NOT NULL, date DATETIME NOT NULL, status VARCHAR(30) NOT NULL, complete TINYINT(1) NOT NULL, INDEX IDX_FE38F844EA724598 (patient_id_id), UNIQUE INDEX UNIQ_FE38F84464E7214B (department_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE department (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, department_id_id INT DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) NOT NULL, middle_names VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, address LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', county VARCHAR(255) DEFAULT NULL, country VARCHAR(255) NOT NULL, eircode VARCHAR(255) DEFAULT NULL, date_of_birth DATE NOT NULL, date_created DATETIME NOT NULL, status VARCHAR(30) NOT NULL, priority VARCHAR(20) NOT NULL, tel_no INT DEFAULT NULL, mobile_no INT DEFAULT NULL, UNIQUE INDEX UNIQ_1ADAD7EB64E7214B (department_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F844EA724598 FOREIGN KEY (patient_id_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F84464E7214B FOREIGN KEY (department_id_id) REFERENCES department (id)');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB64E7214B FOREIGN KEY (department_id_id) REFERENCES department (id)');
        $this->addSql('ALTER TABLE user_staff CHANGE password staff_password VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F84464E7214B');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EB64E7214B');
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F844EA724598');
        $this->addSql('DROP TABLE appointment');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE patient');
        $this->addSql('ALTER TABLE user_staff CHANGE staff_password password VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
