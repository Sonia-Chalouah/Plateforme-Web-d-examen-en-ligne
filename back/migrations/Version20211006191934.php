<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211006191934 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX question_id ON question_answer');
        $this->addSql('ALTER TABLE question_answer CHANGE question_id question_id INT DEFAULT NULL, CHANGE answer_id answer_id INT DEFAULT NULL, CHANGE is_good_answer is_good_answer TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE quiz CHANGE id_type id_type INT DEFAULT NULL, CHANGE generated_by generated_by INT DEFAULT NULL');
        $this->addSql('ALTER TABLE quiz_module_composition CHANGE quiz_type_id quiz_type_id INT DEFAULT NULL, CHANGE module_id module_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE quiz_question CHANGE id_quiz id_quiz INT DEFAULT NULL, CHANGE id_question id_question INT DEFAULT NULL');
        $this->addSql('ALTER TABLE quiz_submission CHANGE question_id question_id INT DEFAULT NULL, CHANGE answer_id answer_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE question_answer CHANGE question_id question_id INT NOT NULL, CHANGE answer_id answer_id INT NOT NULL, CHANGE is_good_answer is_good_answer TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX question_id ON question_answer (question_id, answer_id)');
        $this->addSql('ALTER TABLE quiz CHANGE id_type id_type INT NOT NULL, CHANGE generated_by generated_by INT NOT NULL');
        $this->addSql('ALTER TABLE quiz_module_composition CHANGE module_id module_id INT NOT NULL, CHANGE quiz_type_id quiz_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE quiz_question CHANGE id_question id_question INT NOT NULL, CHANGE id_quiz id_quiz INT NOT NULL');
        $this->addSql('ALTER TABLE quiz_submission CHANGE answer_id answer_id INT NOT NULL, CHANGE question_id question_id INT NOT NULL');
    }
}
