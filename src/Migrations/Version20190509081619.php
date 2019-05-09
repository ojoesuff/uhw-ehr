<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190509081619 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE aand_erecord CHANGE staff_id_id staff_id_id INT DEFAULT NULL, CHANGE notes notes VARCHAR(1000) DEFAULT NULL, CHANGE medication_amount medication_amount VARCHAR(100) DEFAULT NULL, CHANGE medication_name medication_name VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE appointment CHANGE staff_id_id staff_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE macular_clinic_record CHANGE staff_id_id staff_id_id INT DEFAULT NULL, CHANGE notes notes VARCHAR(1000) DEFAULT NULL');
        $this->addSql('ALTER TABLE patient CHANGE department_id department_id INT DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE middle_names middle_names VARCHAR(100) DEFAULT NULL, CHANGE last_name last_name VARCHAR(100) DEFAULT NULL, CHANGE address address LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', CHANGE county county VARCHAR(100) DEFAULT NULL, CHANGE eircode eircode VARCHAR(15) DEFAULT NULL, CHANGE tel_no tel_no INT DEFAULT NULL, CHANGE mobile_no mobile_no INT DEFAULT NULL, CHANGE country country VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE radiology_record CHANGE staff_id_id staff_id_id INT DEFAULT NULL, CHANGE metal_area metal_area VARCHAR(50) DEFAULT NULL, CHANGE notes notes VARCHAR(1000) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD last_patient_id INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL, CHANGE last_name last_name VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64982FDF893 FOREIGN KEY (last_patient_id) REFERENCES patient (id)');
        $this->addSql('CREATE INDEX IDX_8D93D64982FDF893 ON user (last_patient_id)');
        $this->addSql('ALTER TABLE user_staff CHANGE last_name last_name VARCHAR(100) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE aand_erecord CHANGE staff_id_id staff_id_id INT DEFAULT NULL, CHANGE notes notes VARCHAR(1000) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE medication_amount medication_amount VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE medication_name medication_name VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE appointment CHANGE staff_id_id staff_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE macular_clinic_record CHANGE staff_id_id staff_id_id INT DEFAULT NULL, CHANGE notes notes VARCHAR(1000) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE patient CHANGE department_id department_id INT DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE middle_names middle_names VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE last_name last_name VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE address address LONGTEXT DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:array)\', CHANGE county county VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE eircode eircode VARCHAR(15) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE tel_no tel_no INT DEFAULT NULL, CHANGE mobile_no mobile_no INT DEFAULT NULL, CHANGE country country VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE radiology_record CHANGE staff_id_id staff_id_id INT DEFAULT NULL, CHANGE metal_area metal_area VARCHAR(50) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE notes notes VARCHAR(1000) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64982FDF893');
        $this->addSql('DROP INDEX IDX_8D93D64982FDF893 ON user');
        $this->addSql('ALTER TABLE user DROP last_patient_id, CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin, CHANGE last_name last_name VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user_staff CHANGE last_name last_name VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
