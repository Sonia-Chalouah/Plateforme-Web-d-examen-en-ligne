<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211008232402 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quiz_type ADD created_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE quiz_type ADD CONSTRAINT FK_462FAB72B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_462FAB72B03A8386 ON quiz_type (created_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quiz_type DROP FOREIGN KEY FK_462FAB72B03A8386');
        $this->addSql('DROP INDEX IDX_462FAB72B03A8386 ON quiz_type');
        $this->addSql('ALTER TABLE quiz_type DROP created_by_id');
    }
}
