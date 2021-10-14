<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211011150601 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE question_answer DROP FOREIGN KEY question_answer_ibfk_2');
        $this->addSql('ALTER TABLE quiz_submission DROP FOREIGN KEY quiz_submission_ibfk_1');
        $this->addSql('ALTER TABLE quiz_module_composition DROP FOREIGN KEY quiz_module_composition_ibfk_1');
        $this->addSql('ALTER TABLE question_answer DROP FOREIGN KEY question_answer_ibfk_1');
        $this->addSql('ALTER TABLE quiz_question DROP FOREIGN KEY FK_questionnaire_question_id_question');
        $this->addSql('ALTER TABLE quiz_submission DROP FOREIGN KEY quiz_submission_ibfk_2');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EA3E60C9C');
        $this->addSql('ALTER TABLE quiz_submission DROP FOREIGN KEY quiz_submission_ibfk_3');
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY FK_A412FA923101E51F');
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY FK_questionnaire_id_utilisateur');
        $this->addSql('ALTER TABLE quiz_module_composition DROP FOREIGN KEY quiz_module_composition_ibfk_2');
        $this->addSql('ALTER TABLE quiz_question DROP FOREIGN KEY FK_questionnaire_question_id_questionnaire');
        $this->addSql('DROP TABLE answers');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE question_answer');
        $this->addSql('DROP TABLE quiz');
        $this->addSql('DROP TABLE quiz_module_composition');
        $this->addSql('DROP TABLE quiz_question');
        $this->addSql('DROP TABLE quiz_submission');
        $this->addSql('DROP TABLE quiz_type');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answers (id INT AUTO_INCREMENT NOT NULL, libelle TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, helper VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, question_answer_id INT DEFAULT NULL, libel VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, helper VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, image_helper VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_B6F7494EA3E60C9C (question_answer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE question_answer (id INT AUTO_INCREMENT NOT NULL, question_id INT DEFAULT NULL, answer_id INT DEFAULT NULL, is_good_answer TINYINT(1) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX id (id), INDEX answer_id (answer_id), UNIQUE INDEX question_id_2 (question_id, answer_id), UNIQUE INDEX UNIQ_DD80652DAA334807 (answer_id), INDEX IDX_DD80652D1E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE quiz (id INT AUTO_INCREMENT NOT NULL, id_type INT DEFAULT NULL, generated_by INT DEFAULT NULL, quiz_question_id INT DEFAULT NULL, name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX generated_by (generated_by), INDEX FK_questionnaire_id_utilisateur (id_type), INDEX IDX_A412FA923101E51F (quiz_question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE quiz_module_composition (id INT AUTO_INCREMENT NOT NULL, quiz_type_id INT DEFAULT NULL, module_id INT DEFAULT NULL, nb_question INT NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX quiz_type_id (quiz_type_id), INDEX module_id (module_id), INDEX id (id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE quiz_question (id INT AUTO_INCREMENT NOT NULL, id_quiz INT DEFAULT NULL, id_question INT DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, UNIQUE INDEX id_question (id_question, id_quiz), INDEX FK_questionnaire_question_id_questionnaire (id_quiz), INDEX IDX_6033B00BE62CA5DB (id_question), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE quiz_submission (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, quiz_id INT DEFAULT NULL, question_id INT DEFAULT NULL, answer_id INT DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP, INDEX question_id (question_id), INDEX user_id (user_id), INDEX answer_id (answer_id), INDEX quiz_id (quiz_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE quiz_type (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_462FAB72B03A8386 (created_by_id), INDEX id (id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EA3E60C9C FOREIGN KEY (question_answer_id) REFERENCES question_answer (id)');
        $this->addSql('ALTER TABLE question_answer ADD CONSTRAINT question_answer_ibfk_1 FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE question_answer ADD CONSTRAINT question_answer_ibfk_2 FOREIGN KEY (answer_id) REFERENCES answers (id)');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_A412FA923101E51F FOREIGN KEY (quiz_question_id) REFERENCES quiz_question (id)');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_questionnaire_id_utilisateur FOREIGN KEY (id_type) REFERENCES quiz_type (id)');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT quiz_ibfk_1 FOREIGN KEY (generated_by) REFERENCES user (id)');
        $this->addSql('ALTER TABLE quiz_module_composition ADD CONSTRAINT quiz_module_composition_ibfk_1 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE quiz_module_composition ADD CONSTRAINT quiz_module_composition_ibfk_2 FOREIGN KEY (quiz_type_id) REFERENCES quiz_type (id)');
        $this->addSql('ALTER TABLE quiz_question ADD CONSTRAINT FK_questionnaire_question_id_question FOREIGN KEY (id_question) REFERENCES question (id)');
        $this->addSql('ALTER TABLE quiz_question ADD CONSTRAINT FK_questionnaire_question_id_questionnaire FOREIGN KEY (id_quiz) REFERENCES quiz_type (id)');
        $this->addSql('ALTER TABLE quiz_submission ADD CONSTRAINT quiz_submission_ibfk_1 FOREIGN KEY (answer_id) REFERENCES answers (id)');
        $this->addSql('ALTER TABLE quiz_submission ADD CONSTRAINT quiz_submission_ibfk_2 FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE quiz_submission ADD CONSTRAINT quiz_submission_ibfk_3 FOREIGN KEY (quiz_id) REFERENCES quiz (id)');
        $this->addSql('ALTER TABLE quiz_submission ADD CONSTRAINT quiz_submission_ibfk_4 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE quiz_type ADD CONSTRAINT FK_462FAB72B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
    }
}
