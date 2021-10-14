<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211011152829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, INDEX IDX_C242628B03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quiz (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, quiz_type_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, INDEX IDX_A412FA92B03A8386 (created_by_id), INDEX IDX_A412FA92D7162133 (quiz_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quiz_module_composition (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, quiz_type_id INT DEFAULT NULL, module_id INT DEFAULT NULL, nb_question INT NOT NULL, created_at DATETIME DEFAULT NULL, INDEX IDX_F66D8F02B03A8386 (created_by_id), INDEX IDX_F66D8F02D7162133 (quiz_type_id), INDEX IDX_F66D8F02AFC2B591 (module_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quiz_type (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, INDEX IDX_462FAB72B03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_A412FA92B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_A412FA92D7162133 FOREIGN KEY (quiz_type_id) REFERENCES quiz_type (id)');
        $this->addSql('ALTER TABLE quiz_module_composition ADD CONSTRAINT FK_F66D8F02B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE quiz_module_composition ADD CONSTRAINT FK_F66D8F02D7162133 FOREIGN KEY (quiz_type_id) REFERENCES quiz_type (id)');
        $this->addSql('ALTER TABLE quiz_module_composition ADD CONSTRAINT FK_F66D8F02AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE quiz_type ADD CONSTRAINT FK_462FAB72B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quiz_module_composition DROP FOREIGN KEY FK_F66D8F02AFC2B591');
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY FK_A412FA92D7162133');
        $this->addSql('ALTER TABLE quiz_module_composition DROP FOREIGN KEY FK_F66D8F02D7162133');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE quiz');
        $this->addSql('DROP TABLE quiz_module_composition');
        $this->addSql('DROP TABLE quiz_type');
    }
}
