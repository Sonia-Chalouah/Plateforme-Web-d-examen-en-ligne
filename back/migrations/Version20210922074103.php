<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210922074103 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quiz_session_question ADD option_a VARCHAR(255) NOT NULL, ADD option_b VARCHAR(255) NOT NULL, ADD option_c VARCHAR(255) NOT NULL, ADD option_d VARCHAR(255) NOT NULL, ADD correct_ans VARCHAR(255) NOT NULL, ADD score INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quiz_session_question DROP option_a, DROP option_b, DROP option_c, DROP option_d, DROP correct_ans, DROP score');
    }
}
