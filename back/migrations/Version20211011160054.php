<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211011160054 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answers (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, question_answer_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, helper VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, is_good_answer TINYINT(1) NOT NULL, INDEX IDX_50D0C606B03A8386 (created_by_id), INDEX IDX_50D0C606A3E60C9C (question_answer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, quiz_question_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, helper VARCHAR(255) NOT NULL, image_helper VARCHAR(255) NOT NULL, INDEX IDX_B6F7494EB03A8386 (created_by_id), INDEX IDX_B6F7494E3101E51F (quiz_question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question_answer (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, question_id INT DEFAULT NULL, created_at DATETIME DEFAULT NULL, INDEX IDX_DD80652DB03A8386 (created_by_id), INDEX IDX_DD80652D1E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quiz_question (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, quiz_id INT DEFAULT NULL, created_at DATETIME DEFAULT NULL, INDEX IDX_6033B00BB03A8386 (created_by_id), INDEX IDX_6033B00B853CD175 (quiz_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answers ADD CONSTRAINT FK_50D0C606B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE answers ADD CONSTRAINT FK_50D0C606A3E60C9C FOREIGN KEY (question_answer_id) REFERENCES question_answer (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E3101E51F FOREIGN KEY (quiz_question_id) REFERENCES quiz_question (id)');
        $this->addSql('ALTER TABLE question_answer ADD CONSTRAINT FK_DD80652DB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE question_answer ADD CONSTRAINT FK_DD80652D1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE quiz_question ADD CONSTRAINT FK_6033B00BB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE quiz_question ADD CONSTRAINT FK_6033B00B853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE question_answer DROP FOREIGN KEY FK_DD80652D1E27F6BF');
        $this->addSql('ALTER TABLE answers DROP FOREIGN KEY FK_50D0C606A3E60C9C');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E3101E51F');
        $this->addSql('DROP TABLE answers');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE question_answer');
        $this->addSql('DROP TABLE quiz_question');
    }
}
