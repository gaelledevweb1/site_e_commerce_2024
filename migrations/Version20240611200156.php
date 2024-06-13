<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240611200156 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cours_gymnastique_douce_senior ADD nom_cours VARCHAR(255) NOT NULL, ADD description LONGTEXT NOT NULL, ADD image VARCHAR(255) NOT NULL, ADD professeur VARCHAR(255) NOT NULL, ADD detail_cours LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cours_gymnastique_douce_senior DROP nom_cours, DROP description, DROP image, DROP professeur, DROP detail_cours');
    }
}
