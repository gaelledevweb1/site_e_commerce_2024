<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240403123721 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_B3BA5A5AF2EAAF37 ON products');
        $this->addSql('ALTER TABLE products DROP categories_blog_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products ADD categories_blog_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_B3BA5A5AF2EAAF37 ON products (categories_blog_id)');
    }
}
