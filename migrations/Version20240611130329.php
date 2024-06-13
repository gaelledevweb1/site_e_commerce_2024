<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240611130329 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cours_gymnastique_douce_senior DROP FOREIGN KEY FK_1233C0CDA76ED395');
        $this->addSql('DROP INDEX IDX_1233C0CDA76ED395 ON cours_gymnastique_douce_senior');
        $this->addSql('ALTER TABLE cours_gymnastique_douce_senior DROP user_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cours_gymnastique_douce_senior ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cours_gymnastique_douce_senior ADD CONSTRAINT FK_1233C0CDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_1233C0CDA76ED395 ON cours_gymnastique_douce_senior (user_id)');
    }
}
